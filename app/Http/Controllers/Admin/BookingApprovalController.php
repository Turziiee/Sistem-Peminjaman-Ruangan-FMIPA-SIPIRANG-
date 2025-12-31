<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Helpers\ActivityLogger;

class BookingApprovalController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('room', 'user')->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'room']);

        return view('admin.bookings.show', compact('booking'));
    }

    public function approve(Booking $booking)
    {
        if ($booking->status !== 'pending') {
            return back()->with('error', 'Peminjaman sudah diproses sebelumnya');
        }

        $booking->update([
            'status' => 'approved',
            'rejection_reason' => null,
        ]);

        ActivityLogger::log('Menyetujui peminjaman ruangan "' . $booking->room->name . '" oleh ' . ($booking->pemohon_nama ?? $booking->user->name));

        return redirect()->route('admin.bookings.index')->with('success', 'Peminjaman berhasil disetujui');
    }

    public function reject(Request $request, Booking $booking)
    {
        if ($booking->status !== 'pending') {
            return back()->with('error', 'Peminjaman sudah diproses sebelumnya');
        }

        $request->validate([
            'rejection_reason' => 'nullable|string|max:500',
        ]);

        $booking->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
        ]);

        ActivityLogger::log('Menolak peminjaman ruangan "' . $booking->room->name . '" oleh ' . ($booking->pemohon_nama ?? $booking->user->name) . ($request->rejection_reason ? ' | Alasan: ' . $request->rejection_reason : ''));

        return redirect()->route('admin.bookings.index')->with('success', 'Peminjaman berhasil ditolak');
    }
}
