<h2>Kelola FAQ</h2>

<a href="{{ route('admin.faqs.create') }}">➕ Tambah FAQ</a>

@if (session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>Pertanyaan</th>
        <th>Jawaban</th>
        <th>Aksi</th>
    </tr>

    @foreach ($faqs as $index => $faq)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $faq->question }}</td>
            <td>{{ $faq->answer }}</td>
            <td>
                <a href="{{ route('admin.faqs.edit', $faq) }}">Edit</a>

                <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus FAQ?')">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
