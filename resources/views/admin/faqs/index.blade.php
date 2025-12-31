@extends('layouts.guest')

@section('page')
    <div class="max-w-6xl mx-auto px-6 py-8">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-semibold">Kelola FAQ</h1>
                <p class="text-gray-500">
                    Manajemen pertanyaan yang sering diajukan pengguna
                </p>
            </div>

            <button onclick="openCreateModal()"
                class="bg-gray-800 text-white px-5 py-2 rounded-lg hover:bg-gray-900 transition">
                + Tambah FAQ
            </button>
        </div>

        {{-- LIST FAQ --}}
        <div class="space-y-5">
            @forelse ($faqs as $faq)
                <div class="bg-white rounded-xl shadow p-5">

                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-gray-100 text-gray-600">
                            ❓
                        </div>

                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">
                                {{ $faq->question }}
                            </h3>

                            <p class="text-gray-600 text-sm mt-1">
                                {{ $faq->answer }}
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-3 mt-4 pt-4 border-t">
                        <button onclick="openEditModal({{ $faq->id }})"
                            class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                            ✏️ Edit
                        </button>

                        <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus FAQ ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                🗑️ Hapus
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <p class="text-gray-500">Belum ada data FAQ.</p>
            @endforelse
        </div>
    </div>

    {{-- MODAL --}}
    @include('admin.faqs.modal')

    {{-- JS --}}
    <script>
        const modal = document.getElementById('faqModal');
        const form = document.getElementById('faqForm');
        const modalTitle = document.getElementById('modalTitle');
        const methodInput = document.getElementById('formMethod');

        function openCreateModal() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            modalTitle.innerText = 'Tambah FAQ';
            form.action = "{{ route('admin.faqs.store') }}";
            methodInput.value = 'POST';

            form.reset();
        }

        function openEditModal(id) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            modalTitle.innerText = 'Edit FAQ';
            form.action = `/admin/faqs/${id}`;
            methodInput.value = 'PUT';

            fetch(`/admin/faqs/${id}/edit`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('question').value = data.question;
                    document.getElementById('answer').value = data.answer;
                })
                .catch(() => {
                    alert('Gagal mengambil data FAQ');
                });
        }

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
@endsection
