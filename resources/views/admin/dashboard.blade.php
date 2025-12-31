@extends('layouts.guest')

@section('page')
    <main class="bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-6 py-8">

            <!-- HEADER -->
            <div class="mb-8">
                <h1 class="text-2xl font-semibold">Dashboard Admin</h1>
                <p class="text-gray-500">
                    Selamat datang, {{ auth()->user()->name ?? 'Admin' }}
                </p>
            </div>

            <!-- STAT CARDS -->
            <div class="grid grid-cols-5 gap-6 mb-10">

                <div class="bg-white rounded-xl p-5 flex justify-between items-center shadow-sm">
                    <div>
                        <p class="text-sm text-gray-500">Total Ruangan</p>
                        <p class="text-2xl font-semibold">{{ $totalRooms }}</p>
                    </div>
                    <div class="bg-gray-700 text-white p-3 rounded-lg">🏢</div>
                </div>

                <div class="bg-white rounded-xl p-5 flex justify-between items-center shadow-sm">
                    <div>
                        <p class="text-sm text-gray-500">Total Peminjaman</p>
                        <p class="text-2xl font-semibold">{{ $totalBookings }}</p>
                    </div>
                    <div class="bg-blue-500 text-white p-3 rounded-lg">📋</div>
                </div>

                <div class="bg-white rounded-xl p-5 flex justify-between items-center shadow-sm">
                    <div>
                        <p class="text-sm text-gray-500">Disetujui</p>
                        <p class="text-2xl font-semibold">{{ $approvedCount }}</p>
                    </div>
                    <div class="bg-green-500 text-white p-3 rounded-lg">✅</div>
                </div>

                <div class="bg-white rounded-xl p-5 flex justify-between items-center shadow-sm">
                    <div>
                        <p class="text-sm text-gray-500">Pending</p>
                        <p class="text-2xl font-semibold">{{ $pendingCount }}</p>
                    </div>
                    <div class="bg-yellow-400 text-white p-3 rounded-lg">⏳</div>
                </div>

                <div class="bg-white rounded-xl p-5 flex justify-between items-center shadow-sm">
                    <div>
                        <p class="text-sm text-gray-500">Ditolak</p>
                        <p class="text-2xl font-semibold">{{ $rejectedCount }}</p>
                    </div>
                    <div class="bg-red-500 text-white p-3 rounded-lg">❌</div>
                </div>

            </div>

            <!-- AKTIVITAS TERBARU -->
            <div class="bg-white rounded-xl p-6 shadow-sm mb-10">
                <h2 class="text-lg font-semibold mb-4">Aktivitas Terbaru</h2>

                <ul class="space-y-4 text-sm">
                    @forelse ($recentBookings as $booking)
                        <li class="flex justify-between">
                            <div>
                                Ruang {{ $booking->room->name ?? 'Ruangan' }}
                                ({{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }})
                                <div class="text-gray-400 text-xs">
                                    {{ $booking->created_at->diffForHumans() }}
                                </div>
                            </div>

                            @php
                                $statusColor = match ($booking->status) {
                                    'approved' => 'bg-green-100 text-green-600',
                                    'pending' => 'bg-yellow-100 text-yellow-600',
                                    'rejected' => 'bg-red-100 text-red-600',
                                    default => 'bg-gray-100 text-gray-600',
                                };
                            @endphp

                            <span class="px-4 py-1 rounded-full text-sm font-medium {{ $statusColor }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </li>
                    @empty
                        <li class="text-gray-500">
                            Belum ada aktivitas peminjaman.
                        </li>
                    @endforelse
                </ul>
            </div>

            <!-- AKSI CEPAT -->
            <div>
                <h2 class="text-lg font-semibold mb-4">Aksi Cepat</h2>

                <div class="grid grid-cols-2 gap-6">

                    <a href="/admin/rooms"
                        class="bg-white rounded-xl p-6 shadow-sm flex items-center gap-4 hover:bg-gray-50">
                        <div class="bg-gray-700 text-white p-3 rounded-lg">🏢</div>
                        <div>
                            <div class="font-semibold">Kelola Ruangan</div>
                            <div class="text-sm text-gray-500">
                                Tambah & edit data ruangan
                            </div>
                        </div>
                    </a>

                    <a href="/admin/bookings"
                        class="bg-white rounded-xl p-6 shadow-sm flex items-center gap-4 hover:bg-gray-50">
                        <div class="bg-blue-500 text-white p-3 rounded-lg">📑</div>
                        <div>
                            <div class="font-semibold">Kelola Peminjaman</div>
                            <div class="text-sm text-gray-500">
                                Setujui atau tolak pengajuan
                            </div>
                        </div>
                    </a>

                </div>
            </div>

        </div>
    </main>
@endsection
