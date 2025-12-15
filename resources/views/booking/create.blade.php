<h2>Form Peminjaman Ruangan</h2>

@if($errors->any())
    <div style="color:red">
        {{ $errors->first() }}
    </div>
@endif

<form method="POST" action="{{ route('booking.store') }}">
    @csrf

    <input type="hidden" name="room_id" value="{{ $room->id }}">
    <input type="hidden" name="booking_date" value="{{ $date }}">
    <input type="hidden" name="start_time" value="{{ $start }}">
    <input type="hidden" name="end_time" value="{{ $end }}">

    <p><strong>Ruangan:</strong> {{ $room->name }}</p>
    <p><strong>Tanggal:</strong> {{ $date }}</p>
    <p><strong>Waktu:</strong> {{ $start }} - {{ $end }}</p>

    <hr>

    <input name="pemohon_nama" placeholder="Nama Pemohon"><br><br>
    <input name="pemohon_nim" placeholder="NIM"><br><br>
    <input name="activity_name" placeholder="Nama Kegiatan"><br><br>
    <input name="participant_count" type="number" placeholder="Jumlah Peserta"><br><br>

    <textarea name="notes" placeholder="Catatan tambahan (opsional)"></textarea><br><br>

    <button>Ajukan Peminjaman</button>
</form>
