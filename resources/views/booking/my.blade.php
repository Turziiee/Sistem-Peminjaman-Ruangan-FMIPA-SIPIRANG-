<h2>Status Peminjaman Saya</h2>

@if (session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if ($errors->any())
    <p style="color:red">{{ $errors->first() }}</p>
@endif

<table border="1" cellpadding="8">
    <tr>
        <th>Tanggal</th>
        <th>Ruangan</th>
        <th>Waktu</th>
        <th>Kegiatan</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach ($bookings as $booking)
        <tr>
            <td>{{ $booking->booking_date }}</td>
            <td>{{ $booking->room->name }}</td>
            <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
            <td>{{ $booking->activity_name }}</td>
            <td>{{ strtoupper($booking->status) }}</td>
            <td>
                @if ($booking->status === 'pending')
                    <form method="POST" action="{{ route('booking.cancel', $booking) }}">
                        @csrf
                        <button onclick="return confirm('Batalkan peminjaman?')">
                            Batalkan
                        </button>
                    </form>
                @else
                    -
                @endif
            </td>
        </tr>
    @endforeach
</table>
