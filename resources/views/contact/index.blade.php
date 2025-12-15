<h2>Kontak Admin</h2>

@if (session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('contact.store') }}">
    @csrf

    <div>
        <label>Subjek</label><br>
        <input type="text" name="subject" required>
    </div>

    <br>

    <div>
        <label>Pesan</label><br>
        <textarea name="message" rows="5" required></textarea>
    </div>

    <br>

    <button type="submit">Kirim</button>
</form>
