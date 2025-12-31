@extends('layouts.guest')

@section('page')
    <div class="max-w-4xl mx-auto px-6 py-8">

        {{-- BACK --}}
        <a href="{{ route('admin.bookings.index') }}" class="text-sm text-gray-600 mb-4 inline-block">
            ← Kembali ke Kelola Peminjaman
        </a>

        {{-- CARD --}}
        <div class="bg-white rounded-xl shadow p-6 space-y-6">

            {{-- HEADER --}}
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-xl font-semibold">Detail Peminjaman</h1>
                    <p class="text-gray-500 text-sm">
                        Diajukan {{ $booking->created_at->diffForHumans() }}
                    </p>
                </div>

                <span
                    class="px-3 py-1 rounded-full text-sm
                        @if ($booking->status === 'pending') bg-yellow-100 text-yellow-700
                        @elseif ($booking->status === 'approved') bg-green-100 text-green-700
                        @elseif ($booking->status === 'rejected') bg-red-100 text-red-600
                        @else bg-gray-200 text-gray-600 @endif">
                    {{ ucfirst($booking->status) }}
                </span>
            </div>

            {{-- INFO PEMOHON --}}
            <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                <div>
                    <span class="text-gray-500 text-sm">Nama Pemohon</span>
                    <div class="font-medium">{{ $booking->pemohon_nama }}</div>
                </div>

                @if ($booking->pemohon_nim)
                    <div>
                        <span class="text-gray-500 text-sm">NIM</span>
                        <div class="font-medium">{{ $booking->pemohon_nim }}</div>
                    </div>
                @endif

                <div>
                    <span class="text-gray-500 text-sm">Keperluan</span>
                    <div class="font-medium">
                        {{ $booking->activity_name ?? '-' }}
                    </div>
                </div>
            </div>

            {{-- INFO RUANGAN --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-gray-50 rounded-lg p-4">
                    <span class="text-gray-500 text-sm">Ruangan</span>
                    <div class="font-semibold">{{ $booking->room->name }}</div>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <span class="text-gray-500 text-sm">Tanggal</span>
                    <div class="font-semibold">
                        {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <span class="text-gray-500 text-sm">Waktu</span>
                    <div class="font-semibold">
                        {{ substr($booking->start_time, 0, 5) }} -
                        {{ substr($booking->end_time, 0, 5) }}
                    </div>
                </div>
            </div>

            {{-- PESERTA --}}
            <div class="text-sm">
                👥 Jumlah Peserta:
                <strong>{{ $booking->participant_count }} orang</strong>
            </div>

            {{-- CATATAN PEMOHON --}}
            @if ($booking->notes)
                <div class="bg-gray-50 border rounded-lg p-4">
                    <span class="text-gray-500 text-sm">Catatan Pemohon</span>
                    <p class="mt-1 text-gray-700">{{ $booking->notes }}</p>
                </div>
            @endif

            {{-- ALASAN PENOLAKAN --}}
            @if ($booking->status === 'rejected' && $booking->rejection_reason)
                <div class="bg-red-50 border border-red-200 p-4 rounded-lg text-sm text-red-600">
                    <strong>Alasan Penolakan:</strong>
                    <p class="mt-1">{{ $booking->rejection_reason }}</p>
                </div>
            @endif

            {{-- ACTION --}}
            @if ($booking->status === 'pending')
                <div class="flex gap-3 pt-4 border-t">

                    {{-- APPROVE --}}
                    <form method="POST" action="{{ route('admin.bookings.approve', $booking) }}">
                        @csrf
                        <button class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg">
                            Setujui
                        </button>
                    </form>

                    {{-- REJECT --}}
                    <button onclick="openRejectModal()" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg">
                        Tolak
                    </button>
                </div>
            @endif
        </div>
    </div>

    {{-- MODAL REJECT --}}
    @include('admin.bookings.reject-modal')
@endsection
