@extends('layouts.guest')

@section('page')
    {{-- KEMBALI --}}
    <a href="{{ route('room.catalog.index') }}" class="text-sm text-gray-600 mb-4 inline-block">
        ← Kembali ke Daftar Ruangan
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ================== KIRI ================== --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- FOTO RUANGAN --}}
            <div class="rounded-xl overflow-hidden bg-gray-200">
                <img src="{{ $room->image ? asset('storage/' . $room->image) : 'https://via.placeholder.com/800x400' }}"
                    class="w-full h-64 object-cover">
            </div>

            {{-- INFO RUANGAN --}}
            <div class="bg-white rounded-xl p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-xl font-semibold">{{ $room->name }}</h1>
                    <span
                        class="px-3 py-1 rounded-full text-sm
                    {{ $room->status === 'available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                        {{ ucfirst($room->status) }}
                    </span>
                </div>

                <p class="text-gray-600">
                    {{ $room->facilities }}
                </p>

                <div class="flex flex-wrap gap-4 text-sm text-gray-700">
                    <div>👥 Kapasitas: <strong>{{ $room->capacity }} orang</strong></div>
                    <div>📍 Lokasi: <strong>{{ $room->location }}</strong></div>
                </div>
            </div>
        </div>

        {{-- ================== KANAN ================== --}}
        <div class="bg-white rounded-xl p-6 space-y-6">

            <form method="GET" action="{{ route('booking.create') }}">

                {{-- DATA TERSEMBUNYI --}}
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <input type="hidden" name="date" value="{{ $date }}">

                {{-- TANGGAL --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Pilih Tanggal
                    </label>

                    <input type="date" name="booking_date" value="{{ request('date') ?? now()->toDateString() }}"
                        min="{{ now()->toDateString() }}"
                        class="w-full rounded-lg border-gray-300 focus:ring focus:ring-gray-300"
                        onchange="this.form.submit()">
                </div>

                {{-- JAM --}}
                <div class="mb-6">
                    <p class="text-sm font-medium text-gray-700 mb-2">
                        Pilih Jam Peminjaman
                    </p>

                    <div class="grid grid-cols-2 gap-3" id="time-slot-wrapper">
                        @foreach ($timeSlots as $slot)
                            @php
                                $isBooked = $bookings->contains(
                                    fn($b) => $b->start_time <= $slot && $b->end_time > $slot,
                                );
                            @endphp

                            <label
                                class="time-slot flex items-center justify-center px-4 py-3 rounded-lg border text-sm font-medium
                transition cursor-pointer
                {{ $isBooked
                    ? 'bg-red-100 border-red-300 text-red-500 cursor-not-allowed'
                    : 'bg-white border-gray-300 hover:bg-gray-100' }}">
                                <input type="checkbox" name="time_slots[]" value="{{ $slot }}" class="hidden"
                                    {{ $isBooked ? 'disabled' : '' }}>

                                {{ $slot }} - {{ \Carbon\Carbon::parse($slot)->addHour()->format('H:i') }}
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- LEGEND --}}
                <div class="text-sm space-y-2">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-green-500 rounded"></span> Tersedia
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-red-500 rounded"></span> Sudah Dipesan
                    </div>
                </div>

                {{-- SUBMIT --}}
                <div class="mt-8 pt-6 border-t">
                    <button id="submit-booking" type="submit" disabled
                        class="w-full bg-gray-900 text-white py-3 rounded-xl text-lg opacity-50 cursor-not-allowed transition">
                        Ajukan Peminjaman
                    </button>
                </div>

            </form>
        </div>

    </div>
    <script>
        const selectedSlotsContainer = document.getElementById('selected-slots');
        const submitBtn = document.getElementById('submit-booking');
        let selectedSlots = [];

        document.querySelectorAll('.time-slot').forEach(btn => {
            btn.addEventListener('click', () => {
                const slot = btn.dataset.slot;

                if (selectedSlots.includes(slot)) {
                    selectedSlots = selectedSlots.filter(s => s !== slot);
                    btn.classList.remove('bg-green-500', 'text-white');
                    btn.classList.add('border');
                } else {
                    selectedSlots.push(slot);
                    btn.classList.add('bg-green-500', 'text-white');
                    btn.classList.remove('border');
                }

                selectedSlotsContainer.innerHTML = '';
                selectedSlots.forEach(s => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'time_slots[]';
                    input.value = s;
                    selectedSlotsContainer.appendChild(input);
                });

                if (selectedSlots.length > 0) {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                } else {
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                }
            });
        });
    </script>
    <script>
        document.querySelectorAll('.time-slot').forEach(slot => {
            const checkbox = slot.querySelector('input');

            if (!checkbox || checkbox.disabled) return;

            slot.addEventListener('click', () => {
                checkbox.checked = !checkbox.checked;
                slot.classList.toggle('selected', checkbox.checked);

                updateSubmitButton();
            });
        });

        function updateSubmitButton() {
            const checked = document.querySelectorAll('input[name="time_slots[]"]:checked').length;
            const button = document.getElementById('submit-booking');

            if (checked > 0) {
                button.disabled = false;
                button.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                button.disabled = true;
                button.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }
    </script>
    <style>
        .time-slot.selected {
            background-color: #dcfce7;
            /* hijau muda */
            border-color: #22c55e;
            color: #166534;
        }
    </style>
@endsection
