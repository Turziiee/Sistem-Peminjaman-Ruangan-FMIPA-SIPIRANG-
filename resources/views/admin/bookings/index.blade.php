<h2>Daftar Pengajuan Peminjaman</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8">
    <tr>
        <th>Tanggal</th>
        <th>Ruangan</th>
        <th>Waktu</th>
        <th>Pemohon</th>
        <th>Kegiatan</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

@foreach($bookings as $booking)
<tr>
    <td>{{ $booking->booking_date }}</td>
    <td>{{ $booking->room->name }}</td>
    <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
    <td>{{ $booking->pemohon_nama }}</td>
    <td>{{ $booking->activity_name }}</td>
    <td>
        <strong>{{ strtoupper($booking->status) }}</strong>
    </td>
    <td>
        <a href="{{ route('admin.bookings.show', $booking) }}">Detail</a>
    </td>
</tr>
@endforeach
</table>
