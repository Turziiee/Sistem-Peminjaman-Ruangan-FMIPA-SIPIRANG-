<h2>Edit FAQ</h2>

<form method="POST" action="{{ route('admin.faqs.update', $faq) }}">
    @csrf
    @method('PUT')

    <div>
        <label>Pertanyaan</label><br>
        <input type="text" name="question"
               value="{{ $faq->question }}" required>
    </div>

    <br>

    <div>
        <label>Jawaban</label><br>
        <textarea name="answer" rows="5" required>{{ $faq->answer }}</textarea>
    </div>

    <br>

    <button type="submit">Update</button>
</form>

<a href="{{ route('admin.faqs.index') }}">⬅ Kembali</a>
