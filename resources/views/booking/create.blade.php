@extends('layouts.guest')

@section('page')
    <div class="max-w-7xl mx-auto px-6">
        <a href="{{ route('room.catalog.show', $room->id) }}" class="text-sm text-gray-500 mb-4 inline-block">
            ← Kembali ke Jadwal
        </a>

        <h1 class="text-xl font-semibold mb-6">Form Peminjaman Ruangan</h1>

        <form method="POST" action="{{ route('booking.store') }}" class="bg-white rounded-xl p-8 max-w-3xl mx-auto shadow">
            @csrf

            @foreach ($selectedSlots as $slot)
                <input type="hidden" name="time_slots[]" value="{{ $slot }}">
            @endforeach

            {{-- INFO OTOMATIS --}}
            <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                <p class="font-medium">{{ $room->name }}</p>
                <p class="text-sm text-gray-600">
                    {{ \Carbon\Carbon::parse($date)->translatedFormat('l, d F Y') }}
                </p>
                <p class="text-sm text-gray-600">
                    Jam:
                    {{ $selectedSlots->first() }}
                    -
                    {{ \Carbon\Carbon::createFromFormat('H:i', $selectedSlots->last())->addHour()->format('H:i') }}
                </p>
            </div>

            @php
                $startTime = $selectedSlots->first();
                $endTime = \Carbon\Carbon::createFromFormat('H:i', $selectedSlots->last())->addHour()->format('H:i');
            @endphp
            
            <input type="hidden" name="room_id" value="{{ $room->id }}">
            <input type="hidden" name="booking_date" value="{{ $date }}">
            <input type="hidden" name="start_time" value="{{ $startTime }}">
            <input type="hidden" name="end_time" value="{{ $endTime }}">


            <h2 class="text-md font-semibold mt-8 mb-4">Data Pemohon</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-sm mb-1">Nama Lengkap *</label>
                    <input type="text" name="pemohon_nama" required class="w-full border rounded-lg px-4 py-2"
                        placeholder="Nama pemohon">
                </div>

                <div>
                    <label class="block text-sm mb-1">NIM/NIDN *</label>
                    <input type="text" name="pemohon_nim" required class="w-full border rounded-lg px-4 py-2"
                        placeholder="Nomor induk mahasiswa/dosen">
                </div>

            </div>

            {{-- CATATAN --}}
            <div class="mt-6">
                <label class="block text-sm mb-1">Tujuan Peminjaman *</label>
                <input type="text" name="activity_name" required class="w-full border rounded-lg px-4 py-2"
                    placeholder="Contoh: Kuliah IF">
            </div>
            {{-- PESERTA --}}
            <div class="mt-4">
                <label class="block text-sm mb-1">Jumlah Peserta *</label>
                <input type="number" name="participant_count" required class="w-full border rounded-lg px-4 py-2"
                    placeholder="Contoh: 30">
            </div>

            <div class="mt-4">
                <label class="block text-sm mb-1">Catatan Tambahan</label>
                <textarea name="notes" rows="4" class="w-full border rounded-lg px-4 py-2"
                    placeholder="Catatan atau permintaan khusus (opsional)"></textarea>
            </div>
            {{-- SUBMIT --}}
            <div class="flex gap-4 mt-8">
                <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded-lg hover:bg-gray-900">
                    Kirim Pengajuan
                </button>
                <a href="{{ route('room.catalog.show', $room->id) }}" class="px-6 py-2 rounded-lg border">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
