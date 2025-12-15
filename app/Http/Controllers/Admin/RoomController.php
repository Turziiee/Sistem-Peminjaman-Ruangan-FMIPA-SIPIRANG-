<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::latest()->get();
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'capacity' => 'required|integer|min:1',
            'location' => 'required',
            'status' => 'required|in:available,maintenance',
        ]);

        Room::create($request->all());

        return redirect()->route('admin.rooms.index')
                         ->with('success', 'Ruangan berhasil ditambahkan');
    }

    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required',
            'capacity' => 'required|integer|min:1',
            'location' => 'required',
            'status' => 'required|in:available,maintenance',
        ]);

        $room->update($request->all());

        return redirect()->route('admin.rooms.index')
                         ->with('success', 'Ruangan berhasil diperbarui');
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->route('admin.rooms.index')
                         ->with('success', 'Ruangan berhasil dihapus');
    }
}

