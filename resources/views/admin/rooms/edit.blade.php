<h2>Edit Ruangan</h2>

<form method="POST" action="{{ route('admin.rooms.update', $room) }}">
    @csrf
    @method('PUT')

    <input name="name" value="{{ $room->name }}"><br><br>
    <input name="capacity" type="number" value="{{ $room->capacity }}"><br><br>
    <input name="location" value="{{ $room->location }}"><br><br>

    <select name="status">
        <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>Available</option>
        <option value="maintenance" {{ $room->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
    </select><br><br>

    <textarea name="facilities">{{ $room->facilities }}</textarea><br><br>

    <button>Update</button>
</form>
