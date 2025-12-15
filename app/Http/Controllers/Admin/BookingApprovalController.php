<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Helpers\ActivityLogger;

class BookingApprovalController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('room', 'user')->orderBy('created_at', 'desc')->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function approve(Booking $booking)
    {
        $booking->update([
            'status' => 'approved',
            'rejection_reason' => null,
        ]);
        ActivityLogger::log('Menyetujui peminjaman ID ' . $booking->id);

        return redirect()->route('admin.bookings.index')->with('success', 'Peminjaman disetujui');
    }

    public function reject(Request $request, Booking $booking)
    {
        $request->validate([
            'rejection_reason' => 'required',
        ]);

        $booking->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
        ]);
        ActivityLogger::log('Menolak peminjaman ID ' . $booking->id . ' (Alasan: ' . $request->rejection_reason . ')');

        return redirect()->route('admin.bookings.index')->with('success', 'Peminjaman ditolak');
    }
}
