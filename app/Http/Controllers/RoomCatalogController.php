<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Room;
use App\Models\Booking;
use Carbon\Carbon;

class RoomCatalogController extends Controller
{
    public function index()
    {
        $rooms = Room::where('status', 'available')
        ->latest()
        ->paginate(9);

        return view('room-catalog.index', compact('rooms'));
    }

    public function show(Room $room)
    {
        $date = request('date', now()->toDateString());

        // jam operasional FIX
        $timeSlots = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00'];

        // booking pada tanggal itu
        $bookings = Booking::where('room_id', $room->id)
            ->where('booking_date', $date)
            ->whereIn('status', ['pending', 'approved'])
            ->get();

        return view('room-catalog.show', compact('room', 'date', 'timeSlots', 'bookings'));
    }
}
