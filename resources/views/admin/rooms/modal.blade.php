{{-- MODAL BACKDROP --}}
<div id="roomModal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center">

    <div class="bg-white rounded-xl w-full max-w-xl max-h-[90vh] overflow-y-auto p-6 relative">

        <h2 id="modalTitle" class="text-lg font-semibold mb-6">
            Tambah Ruangan
        </h2>

        <form id="roomForm" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">

            {{-- NAMA --}}
            <div class="mb-4">
                <label class="block text-sm mb-1">Nama Ruangan *</label>
                <input type="text" name="name" id="name" class="w-full border rounded-lg px-4 py-2" required>
            </div>

            {{-- KAPASITAS --}}
            <div class="mb-4">
                <label class="block text-sm mb-1">Kapasitas *</label>
                <input type="number" name="capacity" id="capacity" class="w-full border rounded-lg px-4 py-2"
                    required>
            </div>

            {{-- FASILITAS --}}
            <div class="mb-4">
                <label class="block text-sm mb-1">Fasilitas</label>
                <input type="text" name="facilities" id="facilities" class="w-full border rounded-lg px-4 py-2"
                    placeholder="Pisahkan dengan koma, contoh: Proyektor, AC, Wifi">
            </div>

            {{-- LOKASI --}}
            <div class="mb-4">
                <label class="block text-sm mb-1">Lokasi *</label>
                <input type="text" name="location" id="location" class="w-full border rounded-lg px-4 py-2"
                    required>
            </div>

            {{-- STATUS --}}
            <div class="mb-4">
                <label class="block text-sm mb-1">Status *</label>
                <select name="status" id="status" class="w-full border rounded-lg px-4 py-2">
                    <option value="available">Tersedia</option>
                    <option value="unavailable">Tidak Tersedia</option>
                </select>
            </div>

            {{-- IMAGE --}}
            {{-- IMAGE --}}
            <div class="mb-6">
                <label class="block text-sm mb-2 font-medium">Gambar Ruangan</label>

                {{-- Custom File Input --}}
                <div class="flex items-center gap-4">
                    <label for="image"
                        class="cursor-pointer inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 transition text-sm">
                        📁 Pilih Gambar
                    </label>

                    <span id="fileName" class="text-sm text-gray-500">
                        Belum ada file dipilih
                    </span>
                </div>

                <input type="file" name="image" id="image" class="hidden" accept="image/*">

                <img id="imagePreview" class="mt-4 w-full h-40 object-cover rounded-lg hidden border">
            </div>

            {{-- BUTTON --}}
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal()" class="px-5 py-2 border rounded-lg">
                    Batal
                </button>

                <button type="submit" class="px-5 py-2 bg-gray-800 text-white rounded-lg">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
