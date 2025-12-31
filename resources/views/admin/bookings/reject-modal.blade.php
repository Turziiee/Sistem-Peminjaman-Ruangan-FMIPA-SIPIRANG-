<div id="rejectModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-xl w-full max-w-md p-6">
        <h2 class="text-lg font-semibold mb-4">
            Tolak Peminjaman
        </h2>

        <form action="{{ route('admin.bookings.reject', $booking) }}" method="POST">
            @csrf

            <label class="block text-sm mb-2">
                Alasan Penolakan (Opsional)
            </label>

            <textarea name="rejection_reason"
                class="w-full border rounded-lg p-3 text-sm"
                rows="4"
                placeholder="Contoh: Jadwal bentrok, ruangan maintenance, dll."></textarea>

            <div class="flex justify-end gap-3 mt-4">
                <button type="button"
                    onclick="closeRejectModal()"
                    class="px-4 py-2 border rounded-lg">
                    Batal
                </button>

                <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg">
                    Tolak
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openRejectModal() {
        const modal = document.getElementById('rejectModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeRejectModal() {
        const modal = document.getElementById('rejectModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>