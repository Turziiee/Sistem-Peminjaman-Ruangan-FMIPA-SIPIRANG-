@extends('layouts.guest')

@section('page')
    <div class="max-w-7xl mx-auto px-6 py-8">

        {{-- HEADER --}}
        <div class="mb-6">
            <h1 class="text-2xl font-semibold flex items-center gap-2">
                📩 Pesan Kontak
            </h1>
            <p class="text-gray-500">
                Kelola pesan yang dikirim oleh pengguna
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- ================= LEFT : LIST PESAN ================= --}}
            <div class="bg-white rounded-xl shadow p-4 space-y-3 max-h-[600px] overflow-y-auto">

                @forelse ($messages as $msg)
                    <button onclick="loadMessage({{ $msg->id }})"
                        class="w-full text-left p-4 rounded-lg hover:bg-gray-100 transition border">
                        <div class="font-medium">
                            {{ $msg->user?->name ?? 'Anonim' }}
                        </div>

                        <div class="text-sm text-gray-500 truncate">
                            {{ $msg->subject }}
                        </div>

                        <div class="text-xs text-gray-400 mt-1">
                            {{ $msg->created_at->format('d M Y') }}
                        </div>
                    </button>
                @empty
                    <p class="text-gray-500 text-sm">
                        Belum ada pesan masuk
                    </p>
                @endforelse
            </div>

            {{-- ================= RIGHT : DETAIL PESAN ================= --}}
            <div class="md:col-span-2 bg-white rounded-xl shadow p-6">

                <div id="emptyState" class="flex flex-col items-center justify-center h-full text-gray-400">
                    <div class="text-5xl mb-3">✉️</div>
                    <p class="text-lg font-medium">Pilih Pesan</p>
                    <p class="text-sm">Klik pesan di sebelah kiri untuk melihat detail</p>
                </div>

                <div id="messageDetail" class="hidden space-y-6">

                    {{-- HEADER --}}
                    <div class="border-b pb-4">
                        <h2 id="detailSubject" class="text-xl font-semibold"></h2>
                        <p class="text-sm text-gray-500">
                            Dari <span id="detailName"></span> ·
                            <span id="detailEmail"></span>
                        </p>
                        <p class="text-xs text-gray-400 mt-1" id="detailDate"></p>
                    </div>

                    {{-- MESSAGE --}}
                    <div class="bg-gray-50 rounded-lg p-4 text-gray-700 whitespace-pre-line" id="detailMessage">
                    </div>

                    {{-- ACTION --}}
                    <div class="pt-4 border-t flex gap-3">
                        <form id="deleteForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin ingin menghapus pesan ini?')"
                                class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg">
                                🗑 Hapus Pesan
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- ================= JS ================= --}}
    <script>
        function loadMessage(id) {
            fetch(`/admin/contact/${id}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('emptyState').classList.add('hidden');
                    document.getElementById('messageDetail').classList.remove('hidden');

                    document.getElementById('detailSubject').innerText = data.subject;
                    document.getElementById('detailName').innerText = data.user.name;
                    document.getElementById('detailEmail').innerText = data.user.email;
                    document.getElementById('detailDate').innerText = data.created_at;
                    document.getElementById('detailMessage').innerText = data.message;

                    document.getElementById('deleteForm').action =
                        `/admin/contact/${data.id}`;
                })
                .catch(() => {
                    alert('Gagal memuat pesan');
                });
        }
    </script>
@endsection
