<h2>Daftar Ruangan</h2>

<a href="{{ route('admin.rooms.create') }}">Tambah Ruangan</a>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8">
    <tr>
        <th>Nama</th>
        <th>Kapasitas</th>
        <th>Lokasi</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($rooms as $room)
    <tr>
        <td>{{ $room->name }}</td>
        <td>{{ $room->capacity }}</td>
        <td>{{ $room->location }}</td>
        <td>{{ ucfirst($room->status) }}</td>
        <td>
            <a href="{{ route('admin.rooms.edit', $room) }}">Edit</a>

            <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Hapus ruangan?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
