@extends('layouts.guest')

@section('page')
    <div class="max-w-7xl mx-auto px-6 py-8">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-semibold">Kelola Ruangan</h1>
                <p class="text-gray-500">
                    Manajemen data ruangan yang tersedia untuk peminjaman
                </p>
            </div>

            <button onclick="openCreateModal()"
                class="bg-gray-800 text-white px-5 py-2 rounded-lg hover:bg-gray-900 transition">
                + Tambah Ruangan
            </button>
        </div>

        {{-- STAT CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

            <div class="bg-white rounded-xl p-5 shadow-sm flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Total Ruangan</p>
                    <p class="text-2xl font-semibold">{{ $totalRooms }}</p>
                </div>
                <div class="bg-blue-500 text-white p-3 rounded-lg">🏢</div>
            </div>

            <div class="bg-white rounded-xl p-5 shadow-sm flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Ruangan Tersedia</p>
                    <p class="text-2xl font-semibold">{{ $availableRooms }}</p>
                </div>
                <div class="bg-green-500 text-white p-3 rounded-lg">✅</div>
            </div>

            <div class="bg-white rounded-xl p-5 shadow-sm flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Tidak Tersedia</p>
                    <p class="text-2xl font-semibold">{{ $unavailableRooms }}</p>
                </div>
                <div class="bg-red-500 text-white p-3 rounded-lg">❌</div>
            </div>

        </div>

        {{-- ROOM CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            @forelse ($rooms as $room)
                <div class="bg-white rounded-xl shadow-sm p-5 space-y-4">

                    <div class="flex justify-between items-start">
                        <div class="flex gap-3">
                            <div class="w-14 h-14 rounded-lg overflow-hidden bg-gray-200 flex items-center justify-center">
                                @if ($room->image)
                                    <img src="{{ asset('storage/' . $room->image) }}" class="w-full h-full object-cover"
                                        alt="{{ $room->name }}">
                                @else
                                    <span class="text-gray-500 text-xl">🏢</span>
                                @endif
                            </div>
                            <div>
                                <h3 class="font-semibold">{{ $room->name }}</h3>
                                <p class="text-sm text-gray-500">
                                    📍 {{ $room->location }}
                                </p>
                            </div>
                        </div>

                        <span
                            class="px-3 py-1 text-sm rounded-full
                            {{ $room->status === 'available' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                            {{ $room->status === 'available' ? 'Tersedia' : 'Tidak Tersedia' }}
                        </span>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 space-y-2 text-sm text-gray-700">
                        <div>👥 Kapasitas: <strong>{{ $room->capacity }} orang</strong></div>

                        <div>
                            Fasilitas:
                            <div class="flex flex-wrap gap-2 mt-1">
                                @foreach (explode(',', $room->facilities) as $facility)
                                    <span class="px-3 py-1 bg-white border rounded-full text-xs">
                                        {{ trim($facility) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-3 pt-3">
                        <button onclick="openEditModal({{ $room->id }})"
                            class="px-4 py-2 rounded-lg bg-gray-500 text-white hover:bg-gray-600">
                            ✏️ Edit
                        </button>

                        <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus ruangan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                                🗑️ Hapus
                            </button>
                        </form>
                    </div>
                    <div class="mt-8">
                        {{ $rooms->links() }}
                    </div>

                </div>
            @empty
                <p class="text-gray-500">Belum ada data ruangan.</p>
            @endforelse

        </div>
    </div>
    @include('admin.rooms.modal')
    <script>
        const modal = document.getElementById('roomModal');
        const form = document.getElementById('roomForm');
        const methodInput = document.getElementById('formMethod');
        const modalTitle = document.getElementById('modalTitle');

        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const fileName = document.getElementById('fileName');

        const submitBtn = form.querySelector('button[type="submit"]');

        /* =======================
           CREATE MODAL
        ======================= */
        function openCreateModal() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            modalTitle.innerText = 'Tambah Ruangan';
            form.action = "{{ route('admin.rooms.store') }}";
            methodInput.value = 'POST';

            form.reset();
            resetSubmitButton();

            imagePreview.classList.add('hidden');
            imagePreview.src = '';
            fileName.innerText = 'Belum ada file dipilih';
        }

        /* =======================
           EDIT MODAL
        ======================= */
        function openEditModal(id) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            modalTitle.innerText = 'Edit Ruangan';
            form.action = `/admin/rooms/${id}`;
            methodInput.value = 'PUT';

            resetSubmitButton();

            imagePreview.classList.add('hidden');
            imagePreview.src = '';
            fileName.innerText = 'Gambar sebelumnya';

            fetch(`/admin/rooms/${id}/edit`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('name').value = data.name;
                    document.getElementById('capacity').value = data.capacity;
                    document.getElementById('facilities').value = data.facilities ?? '';
                    document.getElementById('location').value = data.location;
                    document.getElementById('status').value = data.status;

                    if (data.image) {
                        imagePreview.src = `/storage/${data.image}`;
                        imagePreview.classList.remove('hidden');
                    }
                })
                .catch(() => {
                    alert('Gagal mengambil data ruangan');
                });
        }

        /* =======================
           CLOSE MODAL
        ======================= */
        function closeModal() {
            if (submitBtn.disabled) return; // ⛔ cegah tutup saat submit
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        /* =======================
           FORM SUBMIT LOCK (STEP 5B)
        ======================= */
        form.addEventListener('submit', function() {
            submitBtn.disabled = true;
            submitBtn.innerText = 'Menyimpan...';
        });

        function resetSubmitButton() {
            submitBtn.disabled = false;
            submitBtn.innerText = 'Simpan';
        }

        /* =======================
           IMAGE PREVIEW
        ======================= */
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];

            if (file) {
                fileName.innerText = file.name;
                imagePreview.src = URL.createObjectURL(file);
                imagePreview.classList.remove('hidden');
            } else {
                fileName.innerText = 'Belum ada file dipilih';
                imagePreview.classList.add('hidden');
            }
        });
    </script>
@endsection
