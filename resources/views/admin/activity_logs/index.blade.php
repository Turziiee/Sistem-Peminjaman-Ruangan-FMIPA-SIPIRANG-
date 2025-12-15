<h2>Log Aktivitas Sistem</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>Waktu</th>
        <th>Pengguna</th>
        <th>Aktivitas</th>
    </tr>

@foreach ($logs as $log)
<tr>
    <td>{{ $log->log_date }}</td>
    <td>{{ $log->user->name ?? '-' }}</td>
    <td>{{ $log->description }}</td>
</tr>
@endforeach
</table>
