<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ActivityLogger;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        $room = Room::findOrFail($request->room_id);

        return view('booking.create', [
            'room' => $room,
            'date' => $request->date,
            'start' => $request->start,
            'end' => $request->end,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'booking_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'pemohon_nama' => 'required',
            'pemohon_nim' => 'required',
            'activity_name' => 'required',
            'participant_count' => 'required|integer|min:1',
        ]);

        $conflict = Booking::where('room_id', $request->room_id)
            ->where('booking_date', $request->booking_date)
            ->whereIn('status', ['pending', 'approved'])
            ->where(function ($q) use ($request) {
                $q->where('start_time', '<', $request->end_time)->where('end_time', '>', $request->start_time);
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
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'pemohon_nama' => $request->pemohon_nama,
            'pemohon_nim' => $request->pemohon_nim,
            'activity_name' => $request->activity_name,
            'participant_count' => $request->participant_count,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);
        ActivityLogger::log('Mengajukan peminjaman ruangan ID ' . $request->room_id . ' pada ' . $request->booking_date . ' (' . $request->start_time . ' - ' . $request->end_time . ')');

        return redirect()->route('schedule.index')->with('success', 'Pengajuan berhasil dikirim.');
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

        $booking->update([
            'status' => 'cancelled',
        ]);
        ActivityLogger::log('Membatalkan peminjaman ID ' . $booking->id);

        return redirect()->back()->with('success', 'Peminjaman berhasil dibatalkan');
    }
    public function myBookings()
    {
        $bookings = Booking::with('room')->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('booking.my', compact('bookings'));
    }
}
