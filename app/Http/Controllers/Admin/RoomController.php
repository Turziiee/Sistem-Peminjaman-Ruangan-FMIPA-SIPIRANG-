<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Booking;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::latest()->paginate(6);

        $totalRooms = Room::count();
        $availableRooms = Room::where('status', 'available')->count();
        $unavailableRooms = Room::where('status', 'maintenance')->count();

        return view('admin.rooms.index', compact('rooms', 'totalRooms', 'availableRooms', 'unavailableRooms'));
    }

    public function edit(Room $room)
    {
        return response()->json([
            'id' => $room->id,
            'name' => $room->name,
            'capacity' => $room->capacity,
            'facilities' => $room->facilities,
            'location' => $room->location,
            'status' => $room->status,
            'image' => $room->image,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'facilities' => 'nullable|string',
            'location' => 'required|string',
            'status' => 'required|in:available,maintenance',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('rooms', 'public');
        }

        Room::create($data);

        return redirect()->route('admin.rooms.index')->with('success', 'Ruangan berhasil ditambahkan');
    }

    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'facilities' => 'nullable|string',
            'location' => 'required|string',
            'status' => 'required|in:available,maintenance',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($room->image && Storage::disk('public')->exists($room->image)) {
                Storage::disk('public')->delete($room->image);
            }

            $data['image'] = $request->file('image')->store('rooms', 'public');
        }

        $room->update($data);

        return redirect()->route('admin.rooms.index')->with('success', 'Ruangan berhasil diperbarui');
    }

    public function destroy(Room $room)
    {
        $hasActiveBooking = Booking::where('room_id', $room->id)
            ->whereIn('status', ['pending', 'approved'])
            ->exists();

        if ($hasActiveBooking) {
            return redirect()->route('admin.rooms.index')->with('error', 'Ruangan tidak dapat dihapus karena masih memiliki peminjaman aktif.');
        }

        $room->delete(); // SOFT DELETE

        return redirect()->route('admin.rooms.index')->with('success', 'Ruangan berhasil dihapus');
    }
}
