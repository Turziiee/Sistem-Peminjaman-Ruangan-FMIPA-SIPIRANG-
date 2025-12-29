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

                <p class="text-gray-600">{{ $room->facilities }}</p>

                <div class="flex flex-wrap gap-4 text-sm text-gray-700">
                    <div>👥 Kapasitas: <strong>{{ $room->capacity }} orang</strong></div>
                    <div>📍 Lokasi: <strong>{{ $room->location }}</strong></div>
                </div>
            </div>
        </div>

        {{-- ================== KANAN ================== --}}
        <div class="bg-white rounded-xl p-6 space-y-6">

            {{-- ================== FORM TANGGAL ================== --}}
            <form method="GET" action="{{ route('room.catalog.show', $room->id) }}">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Pilih Tanggal
                </label>

                <input type="date" name="date" value="{{ $date }}" min="{{ now()->toDateString() }}"
                    class="w-full rounded-lg border-gray-300" onchange="this.form.submit()">
            </form>

            {{-- ================== FORM AJUKAN ================== --}}
            {{-- INI BARU UNTUK BOOKING --}}
            <form method="GET" action="{{ route('booking.create') }}">

                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <input type="hidden" name="booking_date" value="{{ $date }}">

                {{-- JAM --}}
                <div>
                    <p class="text-sm font-medium text-gray-700 mb-2">
                        Pilih Jam Peminjaman
                    </p>

                    <div class="grid grid-cols-2 gap-3">
                        @foreach ($timeSlots as $slot)
                            @php
                                $slotStart = \Carbon\Carbon::createFromFormat('H:i', $slot);
                                $slotEnd = $slotStart->copy()->addHour();

                                $isBooked = $bookings->contains(function ($booking) use ($slotStart, $slotEnd) {
                                    return $slotStart < \Carbon\Carbon::createFromFormat('H:i:s', $booking->end_time) &&
                                        $slotEnd > \Carbon\Carbon::createFromFormat('H:i:s', $booking->start_time);
                                });
                            @endphp

                            <label
                                class="flex items-center justify-center px-4 py-3 rounded-lg border text-sm font-medium transition cursor-pointer
                                {{ $isBooked
                                    ? 'bg-red-100 border-red-300 text-red-500 cursor-not-allowed'
                                    : 'bg-white border-gray-300 hover:bg-gray-100' }}">

                                <input type="checkbox" name="time_slots[]" value="{{ $slot }}" class="hidden peer"
                                    {{ $isBooked ? 'disabled' : '' }}>

                                <span
                                    class="peer-checked:bg-green-100 peer-checked:border-green-400 peer-checked:text-green-700 px-4 py-2 rounded-lg">
                                    {{ $slot }} - {{ \Carbon\Carbon::parse($slot)->addHour()->format('H:i') }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- LEGEND --}}
                <div class="text-sm space-y-2 mt-4">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-green-500 rounded"></span> Tersedia
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-red-500 rounded"></span> Sudah Dipesan
                    </div>
                </div>

                {{-- SUBMIT --}}
                <div class="mt-8 pt-6 border-t">
                    <button type="submit"
                        class="w-full bg-gray-900 text-white py-3 rounded-xl text-lg hover:bg-gray-800 transition">
                        Ajukan Peminjaman
                    </button>
                </div>

            </form>
        </div>

    </div>
@endsection
