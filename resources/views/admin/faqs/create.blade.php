<h2>Tambah FAQ</h2>

<form method="POST" action="{{ route('admin.faqs.store') }}">
    @csrf

    <div>
        <label>Pertanyaan</label><br>
        <input type="text" name="question" required>
    </div>

    <br>

    <div>
        <label>Jawaban</label><br>
        <textarea name="answer" rows="5" required></textarea>
    </div>

    <br>

    <button type="submit">Simpan</button>
</form>

<a href="{{ route('admin.faqs.index') }}">⬅ Kembali</a>
