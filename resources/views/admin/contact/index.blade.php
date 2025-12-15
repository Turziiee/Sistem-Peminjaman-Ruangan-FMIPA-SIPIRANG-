<h2>Pesan dari Pengguna</h2>

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>User</th>
            <th>Subjek</th>
            <th>Pesan</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($messages as $msg)
        <tr>
            <td>{{ $msg->user->name }}</td>
            <td>{{ $msg->subject }}</td>
            <td>{{ $msg->message }}</td>
            <td>{{ $msg->created_at->format('d-m-Y H:i') }}</td>
            <td>
                <form method="POST" action="{{ route('admin.contact.destroy', $msg) }}">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus pesan ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
