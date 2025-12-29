@extends('layouts.guest')

@section('page')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold">Ruangan Tersedia</h1>
        <p class="text-gray-500">
            Pilih ruangan sesuai kebutuhan Anda. Klik untuk melihat detail dan jadwal ketersediaan.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ($rooms as $room)
            <div class="bg-white rounded-xl shadow overflow-hidden">

                {{-- FOTO --}}
                <img src="{{ $room->image ? asset('storage/' . $room->image) : asset('images/room-placeholder.jpg') }}"
                    class="h-48 w-full object-cover" alt="{{ $room->name }}">

                <div class="p-5 space-y-3">
                    <h3 class="text-lg font-semibold">{{ $room->name }}</h3>

                    <p class="text-gray-500 text-sm">
                        {{ Str::limit($room->facilities, 80) }}
                    </p>

                    <div class="text-sm text-gray-600 flex items-center gap-2">
                        👥 {{ $room->capacity }} orang
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('room.catalog.show', $room) }}"
                            class="inline-flex items-center justify-between w-full bg-[#4F4F4F] text-white px-4 py-2 rounded-lg hover:bg-[#3A3A3A]">
                            Lihat Detail & Jadwal →
                        </a>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
@endsection
