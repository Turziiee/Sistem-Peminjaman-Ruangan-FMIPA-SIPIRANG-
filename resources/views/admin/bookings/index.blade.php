@extends('layouts.guest')

@section('page')
    <div class="max-w-7xl mx-auto px-6 py-8">

        {{-- HEADER --}}
        <div class="mb-8">
            <h1 class="text-2xl font-semibold">Kelola Peminjaman</h1>
            <p class="text-gray-500">
                Daftar seluruh pengajuan peminjaman ruangan
            </p>
        </div>

        {{-- TABLE --}}
        <div class="bg-white rounded-xl shadow overflow-hidden">

            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="px-5 py-3 text-left">Pemohon</th>
                        <th class="px-5 py-3 text-left">Ruangan</th>
                        <th class="px-5 py-3 text-left">Tanggal</th>
                        <th class="px-5 py-3 text-left">Waktu</th>
                        <th class="px-5 py-3 text-left">Status</th>
                        <th class="px-5 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse ($bookings as $booking)
                        @php
                            $statusColor = match ($booking->status) {
                                'approved' => 'bg-green-100 text-green-700',
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'rejected' => 'bg-red-100 text-red-600',
                                'cancelled' => 'bg-gray-200 text-gray-600',
                                default => 'bg-gray-100 text-gray-600',
                            };
                        @endphp

                        <tr>
                            <td class="px-5 py-4">
                                <div class="font-medium">{{ $booking->pemohon_nama }}</div>
                                <div class="text-xs text-gray-400">
                                    {{ $booking->pemohon_nim ?? '-' }}
                                </div>
                            </td>

                            <td class="px-5 py-4">
                                {{ $booking->room->name ?? '-' }}
                            </td>

                            <td class="px-5 py-4">
                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                            </td>

                            <td class="px-5 py-4">
                                {{ substr($booking->start_time, 0, 5) }} -
                                {{ substr($booking->end_time, 0, 5) }}
                            </td>

                            <td class="px-5 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusColor }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>

                            <td class="px-5 py-4 text-center">
                                <a href="{{ route('admin.bookings.show', $booking) }}"
                                    class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 text-sm">
                                    Detail
                                </a>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-6 text-center text-gray-500">
                                Belum ada data peminjaman.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

        {{-- PAGINATION --}}
        <div class="mt-6">
            {{ $bookings->links() }}
        </div>

    </div>
@endsection
