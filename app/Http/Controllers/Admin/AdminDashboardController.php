<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Booking;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // ===== STAT COUNTS =====
        $totalRooms = Room::count();

        // tanpa cancelled
        $totalBookings = Booking::whereIn('status', ['pending', 'approved', 'rejected'])->count();

        $approvedCount = Booking::where('status', 'approved')->count();
        $pendingCount  = Booking::where('status', 'pending')->count();
        $rejectedCount = Booking::where('status', 'rejected')->count();

        // ===== AKTIVITAS TERBARU (5 DATA) =====
        $recentBookings = Booking::with('room')
            ->whereIn('status', ['pending', 'approved', 'rejected'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalRooms',
            'totalBookings',
            'approvedCount',
            'pendingCount',
            'rejectedCount',
            'recentBookings'
        ));
    }
}
