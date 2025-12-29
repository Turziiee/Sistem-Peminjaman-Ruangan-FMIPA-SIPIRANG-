@extends('layouts.guest')

@section('page')

    <div class="max-w-7xl mx-auto">

        <!-- HEADER -->
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">
                Status Permintaan Peminjaman Ruangan
            </h1>
            <p class="text-gray-500 text-sm">
                Lihat status permintaan peminjaman ruangan Anda
            </p>
        </div>

        <!-- LIST -->
        <div class="space-y-6">

            @foreach ($bookings as $booking)
                @php
                    $statusColor = match ($booking->status) {
                        'approved' => 'border-green-300 bg-green-50',
                        'rejected' => 'border-red-300 bg-red-50',
                        'pending' => 'border-yellow-300 bg-yellow-50',
                        default => 'border-gray-200 bg-white',
                    };

                    $statusText = match ($booking->status) {
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        'pending' => 'Menunggu Persetujuan',
                        default => ucfirst($booking->status),
                    };
                @endphp

                <div class="border rounded-xl p-6 {{ $statusColor }}">

                    <div class="flex justify-between mb-4">
                        <div>
                            <div class="font-semibold">{{ $statusText }}</div>
                            <div class="text-xs text-gray-500">
                                ID: REQ-{{ str_pad($booking->id, 3, '0', STR_PAD_LEFT) }}
                            </div>
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ $booking->created_at->format('d M Y') }}
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <div class="text-gray-500">Ruangan</div>
                            <div class="font-medium">{{ $booking->room->name ?? '-' }}</div>
                        </div>

                        <div>
                            <div class="text-gray-500">Tanggal</div>
                            <div class="font-medium">{{ $booking->booking_date }}</div>
                        </div>

                        <div>
                            <div class="text-gray-500">Jam</div>
                            <div class="font-medium">{{ $booking->start_time }} – {{ $booking->end_time }}</div>
                        </div>

                        <div>
                            <div class="text-gray-500">Peserta</div>
                            <div class="font-medium">{{ $booking->participant_count }} orang</div>
                        </div>
                    </div>

                    @if ($booking->status === 'pending')
                        <div class="mt-4 flex justify-end">
                            <form method="POST" action="{{ route('booking.cancel', $booking->id) }}"
                                onsubmit="return confirm('Batalkan permintaan ini?')">
                                @csrf
                                <button class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700">
                                    Batalkan
                                </button>
                            </form>
                        </div>
                    @endif

                </div>
            @endforeach

        </div>

        <!-- ================= PAGINATION ================= -->
        @if ($bookings->lastPage() > 1)
            <div class="mt-10 flex justify-center items-center gap-2 text-sm">

                {{-- PREV --}}
                @if ($bookings->onFirstPage())
                    <span class="px-3 py-2 rounded bg-gray-200 text-gray-400 cursor-not-allowed">
                        Sebelumnya
                    </span>
                @else
                    <a href="{{ $bookings->previousPageUrl() }}"
                        class="px-3 py-2 rounded bg-gray-700 text-white hover:bg-gray-800">
                        Sebelumnya
                    </a>
                @endif

                {{-- PAGE NUMBERS --}}
                @for ($i = 1; $i <= $bookings->lastPage(); $i++)
                    @if ($i == $bookings->currentPage())
                        <span class="px-3 py-2 rounded bg-gray-700 text-white font-semibold">
                            {{ $i }}
                        </span>
                    @else
                        <a href="{{ $bookings->url($i) }}" class="px-3 py-2 rounded bg-gray-100 hover:bg-gray-300">
                            {{ $i }}
                        </a>
                    @endif
                @endfor

                {{-- NEXT --}}
                @if ($bookings->hasMorePages())
                    <a href="{{ $bookings->nextPageUrl() }}"
                        class="px-3 py-2 rounded bg-gray-700 text-white hover:bg-gray-800">
                        Berikutnya
                    </a>
                @else
                    <span class="px-3 py-2 rounded bg-gray-200 text-gray-400 cursor-not-allowed">
                        Berikutnya
                    </span>
                @endif

            </div>
        @endif

    </div>

@endsection
