<h2>Detail Pengajuan</h2>

<p><strong>Ruangan:</strong> {{ $booking->room->name }}</p>
<p><strong>Tanggal:</strong> {{ $booking->booking_date }}</p>
<p><strong>Waktu:</strong> {{ $booking->start_time }} - {{ $booking->end_time }}</p>
<p><strong>Pemohon:</strong> {{ $booking->pemohon_nama }} ({{ $booking->pemohon_nim }})</p>
<p><strong>Kegiatan:</strong> {{ $booking->activity_name }}</p>
<p><strong>Jumlah Peserta:</strong> {{ $booking->participant_count }}</p>
<p><strong>Status:</strong> {{ strtoupper($booking->status) }}</p>

@if($booking->status === 'pending')
<hr>

<form method="POST" action="{{ route('admin.bookings.approve', $booking) }}">
    @csrf
    <button style="background:green;color:white">Setujui</button>
</form>

<br>

<form method="POST" action="{{ route('admin.bookings.reject', $booking) }}">
    @csrf
    <textarea name="rejection_reason" placeholder="Alasan penolakan"></textarea><br><br>
    <button style="background:red;color:white">Tolak</button>
</form>
@endif

@if($booking->status === 'rejected')
    <p style="color:red">
        <strong>Alasan:</strong> {{ $booking->rejection_reason }}
    </p>
@endif
