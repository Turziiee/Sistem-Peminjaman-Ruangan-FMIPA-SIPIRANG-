<h2>Tambah Ruangan</h2>

<form method="POST" action="{{ route('admin.rooms.store') }}">
    @csrf

    <input name="name" placeholder="Nama Ruangan"><br><br>
    <input name="capacity" type="number" placeholder="Kapasitas"><br><br>
    <input name="location" placeholder="Lokasi"><br><br>

    <select name="status">
        <option value="available">Available</option>
        <option value="maintenance">Maintenance</option>
    </select><br><br>

    <textarea name="facilities" placeholder="Fasilitas"></textarea><br><br>

    <button>Simpan</button>
</form>
