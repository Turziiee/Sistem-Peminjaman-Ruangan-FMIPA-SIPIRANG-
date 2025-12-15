<h2>Jadwal & Pemesanan</h2>

<form method="GET">
    <input type="date" name="date" value="{{ $date }}">
    <select name="room_id">
        <option value="">-- Pilih Ruangan --</option>
        @foreach($rooms as $room)
            <option value="{{ $room->id }}" {{ $roomId == $room->id ? 'selected' : '' }}>
                {{ $room->name }}
            </option>
        @endforeach
    </select>
    <button>Lihat</button>
</form>

<hr>

@if($roomId)
    <h3>Slot Waktu</h3>

    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:10px;">
        @foreach($slots as $slot)

            @php
                $status = 'available';

                foreach ($bookings as $booking) {
                    if (
                        $slot['start'] < $booking->end_time &&
                        $slot['end'] > $booking->start_time
                    ) {
                        $status = $booking->status === 'approved' ? 'booked' : 'pending';
                        break;
                    }
                }
            @endphp

            <div
                style="
                    padding:15px;
                    text-align:center;
                    border-radius:8px;
                    cursor: {{ $status === 'available' ? 'pointer' : 'not-allowed' }};
                    background:
                        {{ $status === 'available' ? '#d1fae5' :
                           ($status === 'pending' ? '#fef3c7' : '#fee2e2') }};
                "
            >
                <strong>{{ $slot['start'] }} - {{ $slot['end'] }}</strong><br>

                @if($status === 'available')
                    <a href="{{ route('booking.create', [
                        'room_id' => $roomId,
                        'date' => $date,
                        'start' => $slot['start'],
                        'end' => $slot['end']
                    ]) }}">Pilih</a>
                @elseif($status === 'pending')
                    <small>Menunggu</small>
                @else
                    <small>Sudah dipesan</small>
                @endif
            </div>

        @endforeach
    </div>
@endif
