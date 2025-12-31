<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // STAT CARDS
        $activeCount = Booking::where('user_id', $userId)
            ->whereIn('status', ['approved'])
            ->count();

        $pendingCount = Booking::where('user_id', $userId)
            ->where('status', 'pending')
            ->count();

        $approvedCount = Booking::where('user_id', $userId)
            ->where('status', 'approved')
            ->count();

        $rejectedCount = Booking::where('user_id', $userId)
            ->where('status', 'rejected')
            ->count();

        // AKTIVITAS TERBARU (3 terakhir)
        $recentBookings = Booking::with('room')
            ->where('user_id', $userId)
            ->latest()
            ->take(3)
            ->get();

        return view('user.dashboard', compact(
            'activeCount',
            'pendingCount',
            'approvedCount',
            'rejectedCount',
            'recentBookings'
        ));
    }
}
