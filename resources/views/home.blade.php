@extends('layouts.guest')

@section('page')

    {{-- ================= HERO SLIDER ================= --}}
    @if ($rooms->count() > 0)
        <section class="max-w-7xl mx-auto px-6 mt-6">
            <div class="relative rounded-2xl overflow-hidden bg-[#4F4F4F]">

                <div id="slider" class="relative h-[420px]">

                    @forelse ($rooms as $index => $room)
                        <div
                            class="slide absolute inset-0 transition-opacity duration-700
                    {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}">

                            <img src="{{ $room->image ? asset('storage/' . $room->image) : asset('images/room-placeholder.jpg') }}"
                                class="w-full h-full object-cover">

                            <div class="absolute inset-0 bg-black/40"></div>

                            <div class="absolute bottom-6 left-6 text-white max-w-md">
                                <h3 class="text-xl font-semibold">{{ $room->name }}</h3>

                                <div class="flex flex-wrap gap-2 mt-3 text-xs">
                                    <span class="bg-white/20 px-3 py-1 rounded-full">
                                        👥 {{ $room->capacity }} orang
                                    </span>

                                    @foreach (array_slice(explode(',', $room->facilities), 0, 3) as $facility)
                                        @if (trim($facility))
                                            <span class="bg-white/20 px-3 py-1 rounded-full">
                                                {{ trim($facility) }}
                                            </span>
                                        @endif
                                    @endforeach
                                </div>

                                <a href="{{ route('room.catalog.show', $room) }}"
                                    class="inline-flex items-center gap-2 mt-4 bg-white text-gray-800 px-4 py-2 rounded-lg text-sm">
                                    Lihat Detail & Jadwal →
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="h-[420px] flex items-center justify-center text-white">
                            Belum ada ruangan tersedia
                        </div>
                    @endforelse
                </div>

                {{-- NAV --}}
                @if ($rooms->count() > 1)
                    <button onclick="prevSlide()"
                        class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/40 w-10 h-10 rounded-full z-20 text-black">‹</button>
                    <button onclick="nextSlide()"
                        class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/40 w-10 h-10 rounded-full z-20 text-black">›</button>
                @endif
            </div>
        </section>
    @endif

    {{-- ================= CTA ================= --}}
    <section class="mt-10">
        <div class="max-w-7xl mx-auto px-6">
            <div
                class="rounded-2xl bg-gradient-to-r from-[#4F4F4F] to-[#3F3F3F] text-white px-8 py-8 flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-semibold">Siap Meminjam Ruangan?</h3>
                    <p class="text-sm text-gray-200 mt-1">
                        Login untuk mengajukan peminjaman ruangan sekarang
                    </p>
                </div>
                <a href="/login" class="bg-white text-gray-800 px-5 py-2 rounded-lg text-sm font-medium">
                    Login Sekarang
                </a>
            </div>
        </div>
    </section>

    {{-- ================= JADWAL MENDATANG ================= --}}
    <section class="mt-16">
        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-xl font-semibold mb-6">📅 Jadwal Mendatang</h2>

            <div class="grid grid-cols-2 gap-6">

                @forelse ($upcomingBookings as $booking)
                    <div class="bg-white rounded-xl border p-5 shadow-sm">
                        <div class="flex justify-between mb-3">
                            <h3 class="font-semibold">
                                {{ $booking->activity_name }}
                            </h3>
                            <span class="text-xs bg-green-100 text-green-600 px-3 py-1 rounded-full">
                                Akan Datang
                            </span>
                        </div>

                        <div class="text-sm text-gray-600 space-y-1">
                            <div>📍 {{ $booking->room->name }}</div>
                            <div>📅 {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</div>
                            <div>⏰ {{ substr($booking->start_time, 0, 5) }} - {{ substr($booking->end_time, 0, 5) }}</div>
                            <div>👤 {{ $booking->pemohon_nama }}</div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 col-span-2">Belum ada jadwal mendatang</p>
                @endforelse

            </div>
        </div>
    </section>
    <!-- KEUNGGULAN SISTEM -->
    <section class="mt-20">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Judul -->
            <div class="text-center mb-12">
                <h2 class="text-2xl font-semibold text-gray-800">
                    Keunggulan Sistem
                </h2>
                <p class="text-sm text-gray-500 mt-2 max-w-xl mx-auto">
                    SIPIRANG FMIPA menyediakan solusi lengkap untuk pengelolaan
                    peminjaman ruangan di lingkungan FMIPA
                </p>
            </div>

            <!-- Grid Keunggulan -->
            <div class="grid grid-cols-4 gap-6">

                <!-- Card 1 -->
                <div
                    class="bg-white border border-gray-200 rounded-xl p-6 text-center shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 mx-auto mb-4 bg-gray-100 rounded-lg flex items-center justify-center text-xl">
                        📅
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">
                        Sistem Penjadwalan Terintegrasi
                    </h3>
                    <p class="text-sm text-gray-500">
                        Kelola jadwal peminjaman ruangan dengan mudah melalui
                        sistem kalender yang terintegrasi.
                    </p>
                </div>

                <!-- Card 2 -->
                <div
                    class="bg-white border border-gray-200 rounded-xl p-6 text-center shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 mx-auto mb-4 bg-gray-100 rounded-lg flex items-center justify-center text-xl">
                        🏢
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">
                        Beragam Pilihan Ruangan
                    </h3>
                    <p class="text-sm text-gray-500">
                        Laboratorium, ruang seminar, ruang kelas, dan ruang rapat
                        dengan fasilitas lengkap.
                    </p>
                </div>

                <!-- Card 3 -->
                <div
                    class="bg-white border border-gray-200 rounded-xl p-6 text-center shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 mx-auto mb-4 bg-gray-100 rounded-lg flex items-center justify-center text-xl">
                        👥
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">
                        Multi-User Access
                    </h3>
                    <p class="text-sm text-gray-500">
                        Akses untuk dosen, mahasiswa, dan admin dengan sistem
                        role-based yang aman.
                    </p>
                </div>

                <!-- Card 4 -->
                <div
                    class="bg-white border border-gray-200 rounded-xl p-6 text-center shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 mx-auto mb-4 bg-gray-100 rounded-lg flex items-center justify-center text-xl">
                        🛡️
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">
                        Proses Persetujuan Cepat
                    </h3>
                    <p class="text-sm text-gray-500">
                        Pengajuan peminjaman diproses secara online dengan
                        notifikasi real-time.
                    </p>
                </div>

            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let currentSlide = 0;
            const slides = document.querySelectorAll('.slide');

            if (slides.length === 0) return;

            function showSlide(index) {
                slides.forEach((slide, i) => {
                    slide.classList.toggle('opacity-100', i === index);
                    slide.classList.toggle('opacity-0', i !== index);
                    slide.classList.toggle('z-10', i === index);
                    slide.classList.toggle('z-0', i !== index);
                });
            }

            window.nextSlide = function() {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            }

            window.prevSlide = function() {
                currentSlide = (currentSlide - 1 + slides.length) % slides.length;
                showSlide(currentSlide);
            }

            // Auto slide
            setInterval(() => {
                nextSlide();
            }, 5000);

        });
    </script>
@endsection
