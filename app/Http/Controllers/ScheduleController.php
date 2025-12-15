<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->get('date', now()->toDateString());
        $roomId = $request->get('room_id');

        $rooms = Room::where('status', 'available')->get();
        $slots = $this->generateTimeSlots();

        $bookings = collect();

        if ($roomId) {
            $bookings = Booking::where('room_id', $roomId)
                ->where('booking_date', $date)
                ->whereIn('status', ['pending', 'approved'])
                ->get();
        }

        return view('schedule.index', compact('date', 'rooms', 'roomId', 'slots', 'bookings'));
    }

    private function generateTimeSlots()
    {
        $slots = [];
        $start = Carbon::createFromTime(8, 0);
        $end = Carbon::createFromTime(16, 0);

        while ($start < $end) {
            $slots[] = [
                'start' => $start->format('H:i'),
                'end' => $start->copy()->addHour()->format('H:i'),
            ];
            $start->addHour();
        }

        return $slots;
    }
}
