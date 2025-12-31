<div id="faqModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    {{-- MODAL BOX --}}
    <div class="bg-white rounded-xl w-full max-w-xl p-6">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-6">
            <h2 id="modalTitle" class="text-lg font-semibold">
                Tambah FAQ
            </h2>

            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700 text-xl">
                ✕
            </button>
        </div>

        {{-- FORM --}}
        <form id="faqForm" method="POST">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">

            {{-- PERTANYAAN --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Pertanyaan <span class="text-red-500">*</span>
                </label>

                <input type="text" id="question" name="question" required placeholder="Masukkan pertanyaan FAQ"
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2
                           focus:ring-2 focus:ring-gray-200 focus:border-gray-400">
            </div>

            {{-- JAWABAN --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Jawaban <span class="text-red-500">*</span>
                </label>

                <textarea id="answer" name="answer" rows="5" required placeholder="Masukkan jawaban FAQ"
                    class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2
                           focus:ring-2 focus:ring-gray-200 focus:border-gray-400 resize-none"></textarea>
            </div>

            {{-- ACTION --}}
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal()"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">
                    Batal
                </button>

                <button type="submit" class="px-5 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
