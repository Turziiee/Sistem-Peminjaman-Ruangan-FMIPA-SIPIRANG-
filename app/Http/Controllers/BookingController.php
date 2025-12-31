<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ActivityLogger;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'booking_date' => 'required|date',
            'time_slots' => 'required|array|min:1',
        ]);

        $room = Room::findOrFail($request->room_id);

        // ⛔ BLOK JIKA MAINTENANCE
        if ($room->status === 'maintenance') {
            return redirect()
                ->route('room.catalog.show', $room)
                ->withErrors([
                    'maintenance' => 'Ruangan sedang maintenance dan tidak dapat dipesan.',
                ]);
        }

        $times = collect($request->time_slots)->sort()->values();

        if ($times->count() < 1) {
            return back()->withErrors('Pilih minimal 1 slot jam');
        }

        $startTime = $times->first();
        $endTime = Carbon::parse($times->last())->addHour()->format('H:i');

        return view('booking.create', [
            'room' => $room,
            'date' => $request->booking_date,
            'selectedSlots' => $times,
            'user' => Auth::user(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'booking_date' => 'required|date',
            'time_slots' => 'required|array|min:1',
            'pemohon_nama' => 'required',
            'pemohon_nim' => 'required',
            'activity_name' => 'required',
            'participant_count' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $room = Room::findOrFail($request->room_id);

        if ($room->status === 'maintenance') {
            return back()->withErrors([
                'maintenance' => 'Ruangan sedang maintenance dan tidak dapat dipesan.',
            ]);
        }

        $slots = collect($request->time_slots)->sort()->values();

        $startTime = $slots->first();
        $endTime = Carbon::createFromFormat('H:i', $slots->last())->addHour()->format('H:i');

        $conflict = Booking::where('room_id', $request->room_id)
            ->where('booking_date', $request->booking_date)
            ->whereIn('status', ['pending', 'approved'])
            ->where(function ($q) use ($startTime, $endTime) {
                $q->where('start_time', '<', $endTime)
                  ->where('end_time', '>', $startTime);
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors([
                'conflict' => 'Waktu yang dipilih sudah digunakan.',
            ]);
        }

        Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'booking_date' => $request->booking_date,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'pemohon_nama' => $request->pemohon_nama,
            'pemohon_nim' => $request->pemohon_nim,
            'activity_name' => $request->activity_name,
            'participant_count' => $request->participant_count,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);

        ActivityLogger::log(
            'Mengajukan peminjaman ruangan ID ' .
            $request->room_id . ' pada ' .
            $request->booking_date . ' (' .
            $startTime . ' - ' . $endTime . ')'
        );

        return redirect()->route('booking.my')->with('success', 'Pengajuan berhasil dikirim.');
    }

    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->status !== 'pending') {
            return back()->withErrors([
                'cancel' => 'Peminjaman tidak dapat dibatalkan',
            ]);
        }

        $booking->update(['status' => 'cancelled']);

        ActivityLogger::log('Membatalkan peminjaman ID ' . $booking->id);

        return back()->with('success', 'Peminjaman berhasil dibatalkan');
    }

    public function myBookings()
    {
        $bookings = Booking::with('room')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(3);

        return view('booking.my', compact('bookings'));
    }
}
