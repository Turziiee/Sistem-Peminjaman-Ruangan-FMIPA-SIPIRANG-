@extends('layouts.guest')

@section('page')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold">Daftar Ruangan</h1>
        <p class="text-gray-500">
            Pilih ruangan sesuai kebutuhan Anda. Ruangan yang sedang maintenance tidak dapat dipesan.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ($rooms as $room)
            <div class="bg-white rounded-xl shadow overflow-hidden relative">

                {{-- FOTO --}}
                <img src="{{ $room->image ? asset('storage/' . $room->image) : asset('images/room-placeholder.jpg') }}"
                    class="h-48 w-full object-cover {{ $room->status === 'maintenance' ? 'grayscale brightness-75' : '' }}"
                    alt="{{ $room->name }}">

                {{-- BADGE MAINTENANCE --}}
                @if ($room->status === 'maintenance')
                    <span class="absolute top-3 left-3 bg-red-600 text-white text-xs px-3 py-1 rounded-full shadow">
                        Sedang Maintenance
                    </span>
                @endif

                <div class="p-5 space-y-3">
                    <h3 class="text-lg font-semibold">{{ $room->name }}</h3>

                    <div class="text-sm text-gray-600">
                        Fasilitas:
                        <div class="flex flex-wrap gap-2 mt-2">
                            @foreach (explode(',', $room->facilities) as $facility)
                                @if (trim($facility) !== '')
                                    <span class="px-3 py-1 text-xs bg-white border rounded-full">
                                        {{ trim($facility) }}
                                    </span>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="text-sm text-gray-600">
                        👥 {{ $room->capacity }} orang
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('room.catalog.show', $room) }}"
                            class="inline-flex items-center justify-between w-full px-4 py-2 rounded-lg text-white
                            {{ $room->status === 'maintenance' ? 'bg-red-500 cursor-not-allowed' : 'bg-[#4F4F4F] hover:bg-[#3A3A3A]' }}">
                            {{ $room->status === 'maintenance' ? 'Tidak Dapat Dipesan' : 'Lihat Detail & Jadwal →' }}
                        </a>
                    </div>
                </div>

            </div>
        @endforeach
    </div>

    <div class="mt-10">
        {{ $rooms->links() }}
    </div>
@endsection
