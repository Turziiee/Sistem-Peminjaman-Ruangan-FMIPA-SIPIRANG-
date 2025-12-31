@extends('layouts.guest')

@section('page')
    {{-- KEMBALI --}}
    <a href="{{ route('room.catalog.index') }}" class="text-sm text-gray-600 mb-4 inline-block">
        ← Kembali ke Daftar Ruangan
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ================== KIRI ================== --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- FOTO --}}
            <div class="rounded-xl overflow-hidden relative">
                <img src="{{ $room->image ? asset('storage/' . $room->image) : 'https://via.placeholder.com/800x400' }}"
                    class="w-full h-64 object-cover {{ $room->status === 'maintenance' ? 'grayscale brightness-75' : '' }}">

                @if ($room->status === 'maintenance')
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none z-10">
                        <span class="bg-red-600 text-white px-6 py-3 rounded-xl text-lg font-semibold shadow">
                            Sedang Maintenance
                        </span>
                    </div>
                @endif
            </div>

            {{-- INFO --}}
            <div class="bg-white rounded-xl p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-xl font-semibold">{{ $room->name }}</h1>

                    <span
                        class="px-3 py-1 rounded-full text-sm
                        {{ $room->status === 'available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                        {{ ucfirst($room->status) }}
                    </span>
                </div>

                <div>
                    <p class="font-medium mb-2">Fasilitas:</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach (explode(',', $room->facilities) as $facility)
                            @if (trim($facility) !== '')
                                <span class="px-3 py-1 text-xs bg-white border rounded-full">
                                    {{ trim($facility) }}
                                </span>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="flex flex-wrap gap-4 text-sm text-gray-700">
                    <div>👥 Kapasitas: <strong>{{ $room->capacity }} orang</strong></div>
                    <div>📍 Lokasi: <strong>{{ $room->location }}</strong></div>
                </div>
            </div>
        </div>

        {{-- ================== KANAN ================== --}}
        <div class="bg-white rounded-xl p-6 space-y-6 relative z-20">

            {{-- TANGGAL --}}
            <form method="GET" action="{{ route('room.catalog.show', $room) }}">
                <label class="block text-sm font-medium mb-1">Pilih Tanggal</label>
                <input type="date" name="date" value="{{ $date }}" min="{{ now()->toDateString() }}"
                    class="w-full rounded-lg border-gray-300" onchange="this.form.submit()">
            </form>

            {{-- MAINTENANCE MESSAGE --}}
            @if ($room->status === 'maintenance')
                <div class="bg-red-50 border border-red-200 text-red-600 p-4 rounded-lg text-sm">
                    Ruangan ini sedang dalam masa maintenance dan sementara tidak dapat dipesan.
                </div>
            @else
                {{-- ================== BOOKING FORM ================== --}}
                <form method="GET" action="{{ route('booking.create') }}">
                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                    <input type="hidden" name="booking_date" value="{{ $date }}">

                    <p class="text-sm font-medium mb-2">Pilih Jam Peminjaman</p>

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
                                    class="px-4 py-2 rounded-lg peer-checked:bg-green-100 peer-checked:border peer-checked:border-green-400 peer-checked:text-green-700">
                                    {{ $slot }} - {{ \Carbon\Carbon::parse($slot)->addHour()->format('H:i') }}
                                </span>
                            </label>
                        @endforeach
                    </div>

                    <div class="mt-6 pt-6 border-t">
                        <button type="submit" class="w-full bg-gray-900 text-white py-3 rounded-xl hover:bg-gray-800">
                            Ajukan Peminjaman
                        </button>
                    </div>
                </form>
            @endif

        </div>
    </div>
@endsection
