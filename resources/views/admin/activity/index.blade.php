@extends('layouts.guest')

@section('page')
    <div class="max-w-7xl mx-auto px-6 py-8">

        {{-- HEADER --}}
        <div class="mb-8">
            <h1 class="text-2xl font-semibold">Riwayat Aktivitas</h1>
            <p class="text-gray-500">
                Log aktivitas admin dan user dalam sistem peminjaman ruangan
            </p>
        </div>

        {{-- TIMELINE --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-lg font-semibold mb-6">Timeline Aktivitas</h2>

            <ul class="space-y-6">
                @forelse ($activities as $activity)
                    @php
                        $desc = $activity->description;

                        /*
                        |==================================================
                        | GANTI ID → NAMA RUANGAN (TANPA TAMBAH TABEL)
                        |==================================================
                        */

                        // ruangan ID X
                        if (preg_match('/ruangan ID (\d+)/', $desc, $match)) {
                            $room = \App\Models\Room::find($match[1]);
                            if ($room) {
                                $desc = str_replace(
                                    'ruangan ID ' . $match[1],
                                    'ruangan ' . $room->name,
                                    $desc
                                );
                            }
                        }

                        // peminjaman ID X
                        if (preg_match('/peminjaman ID (\d+)/', $desc, $match)) {
                            $booking = \App\Models\Booking::with('room')->find($match[1]);
                            if ($booking && $booking->room) {
                                $desc = str_replace(
                                    'peminjaman ID ' . $match[1],
                                    'peminjaman ruangan ' . $booking->room->name,
                                    $desc
                                );
                            }
                        }


                        if (str_contains($activity->description, 'Menyetujui')) {
                            $icon = '✅';
                            $color = 'bg-green-100 text-green-600';
                            $title = 'Menyetujui peminjaman';
                        } elseif (str_contains($activity->description, 'Menolak')) {
                            $icon = '❌';
                            $color = 'bg-red-100 text-red-600';
                            $title = 'Menolak peminjaman';
                        } elseif (str_contains($activity->description, 'Membatalkan')) {
                            $icon = '⛔';
                            $color = 'bg-gray-200 text-gray-700';
                            $title = 'Membatalkan peminjaman';
                        } elseif (str_contains($activity->description, 'Mengajukan')) {
                            $icon = '📝';
                            $color = 'bg-blue-100 text-blue-600';
                            $title = 'Mengajukan peminjaman';
                        } elseif (str_contains($activity->description, 'ruangan')) {
                            $icon = '🏢';
                            $color = 'bg-indigo-100 text-indigo-600';
                            $title = 'Kelola ruangan';
                        } elseif (str_contains($activity->description, 'FAQ')) {
                            $icon = '📄';
                            $color = 'bg-purple-100 text-purple-600';
                            $title = 'Kelola FAQ';
                        } else {
                            $icon = '📌';
                            $color = 'bg-gray-100 text-gray-600';
                            $title = 'Aktivitas sistem';
                        }
                    @endphp

                    <li class="flex justify-between items-start">
                        <div class="flex gap-4">
                            <div class="w-10 h-10 flex items-center justify-center rounded-lg {{ $color }}">
                                {{ $icon }}
                            </div>

                            <div>
                                <div class="font-medium">{{ $title }}</div>

                                <div class="text-sm text-gray-600">
                                    {{ $desc }}
                                </div>

                                <div class="text-xs text-gray-400 mt-1">
                                    Oleh:
                                    <strong>{{ $activity->user->name ?? 'System' }}</strong>
                                    • {{ \Carbon\Carbon::parse($activity->log_date)->format('d M Y H:i') }}
                                </div>
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="text-gray-500 text-sm">
                        Belum ada aktivitas tercatat.
                    </li>
                @endforelse
            </ul>

            {{-- PAGINATION --}}
            <div class="mt-8">
                {{ $activities->links() }}
            </div>
        </div>

    </div>
@endsection
