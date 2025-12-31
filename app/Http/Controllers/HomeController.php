<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $rooms = Room::where('status', 'available')
            ->latest()
            ->take(5)
            ->get();

        $upcomingBookings = Booking::with('room')
            ->where('status', 'approved')
            ->whereDate('booking_date', '>=', now()->toDateString())
            ->orderBy('booking_date')
            ->orderBy('start_time')
            ->take(4)
            ->get();

        return view('home', compact('rooms', 'upcomingBookings'));
    }
}
