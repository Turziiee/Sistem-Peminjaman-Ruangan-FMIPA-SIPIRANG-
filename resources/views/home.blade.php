@extends('layouts.guest')

@section('page')
    <section class="max-w-7xl mx-auto px-6 mt-6">

        <div class="relative rounded-2xl overflow-hidden bg-[#4F4F4F]">

            {{-- SLIDES --}}
            <div id="slider" class="relative h-[420px]">

                {{-- Slide 1 --}}
                <div class="slide absolute inset-0 opacity-100 transition-opacity duration-700">
                    <img src="{{ asset('assets/dummy.JPG') }}" class="w-full h-full object-cover" />
                    <div class="absolute inset-0 bg-black/40"></div>

                    <div class="absolute bottom-6 left-6 text-white max-w-md">
                        <h3 class="text-xl font-semibold">Ruang Rapat A</h3>
                        <p class="text-sm mt-1">
                            Ruang rapat eksklusif untuk pertemuan formal dan diskusi kelompok
                        </p>

                        <div class="flex flex-wrap gap-2 mt-3 text-xs">
                            <span class="bg-white/20 px-3 py-1 rounded-full">20 orang</span>
                            <span class="bg-white/20 px-3 py-1 rounded-full">TV LED 55"</span>
                            <span class="bg-white/20 px-3 py-1 rounded-full">AC</span>
                            <span class="bg-white/20 px-3 py-1 rounded-full">Meja Rapat</span>
                        </div>

                        <a href="/room-catalog"
                            class="inline-flex items-center gap-2 mt-4 bg-white text-gray-800 px-4 py-2 rounded-lg text-sm">
                            Lihat Detail & Jadwal →
                        </a>
                    </div>
                </div>

                {{-- Slide 2 --}}
                <div class="slide absolute inset-0 opacity-0 transition-opacity duration-700">
                    <img src="{{ asset('assets/dummy.JPG') }}" class="w-full h-full object-cover" />
                    <div class="absolute inset-0 bg-black/40"></div>

                    <div class="absolute bottom-6 left-6 text-white max-w-md">
                        <h3 class="text-xl font-semibold">Ruang Seminar A</h3>
                        <p class="text-sm mt-1">
                            Cocok untuk seminar dan presentasi skala besar
                        </p>
                        <div class="flex flex-wrap gap-2 mt-3 text-xs">
                            <span class="bg-white/20 px-3 py-1 rounded-full">20 orang</span>
                            <span class="bg-white/20 px-3 py-1 rounded-full">TV LED 55"</span>
                            <span class="bg-white/20 px-3 py-1 rounded-full">AC</span>
                            <span class="bg-white/20 px-3 py-1 rounded-full">Meja Rapat</span>
                        </div>

                        <a href="/room-catalog"
                            class="inline-flex items-center gap-2 mt-4 bg-white text-gray-800 px-4 py-2 rounded-lg text-sm">
                            Lihat Detail & Jadwal →
                        </a>
                    </div>
                </div>

            </div>

            {{-- ARROW --}}
            <button onclick="prevSlide()"
                class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/30 hover:bg-white/50 text-white w-10 h-10 rounded-full">
                ‹
            </button>

            <button onclick="nextSlide()"
                class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/30 hover:bg-white/50 text-white w-10 h-10 rounded-full">
                ›
            </button>

            {{-- DOTS --}}
            <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-2">
                <span class="dot w-2.5 h-2.5 bg-white rounded-full opacity-100"></span>
                <span class="dot w-2.5 h-2.5 bg-white rounded-full opacity-40"></span>
            </div>

        </div>
    </section>
    <!-- CTA SECTION -->
<section class="mt-10">
    <div class="max-w-7xl mx-auto px-6">
        <div
            class="rounded-2xl bg-gradient-to-r from-[#4F4F4F] to-[#3F3F3F] text-white px-8 py-8 flex items-center justify-between">

            <!-- Text -->
            <div>
                <h3 class="text-xl font-semibold">
                    Siap Meminjam Ruangan?
                </h3>
                <p class="text-sm text-gray-200 mt-1">
                    Login atau daftar untuk mengajukan peminjaman ruangan sekarang
                </p>
            </div>

            <!-- Buttons -->
            <div class="flex items-center gap-4">
                <a href="/login"
                   class="bg-white text-gray-800 px-5 py-2 rounded-lg text-sm font-medium hover:bg-gray-200 transition">
                    Login Sekarang →
                </a>
            </div>

        </div>
    </div>
</section>
<!-- JADWAL MENDATANG -->
<section class="mt-16">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Judul -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
                📅 Jadwal Mendatang
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Lihat jadwal peminjaman ruangan yang akan berlangsung
            </p>
        </div>

        <!-- Grid Card -->
        <div class="grid grid-cols-2 gap-6">

            <!-- CARD 1 -->
            <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="font-semibold text-gray-800">
                        Praktikum Algoritma dan Pemrograman
                    </h3>
                    <span class="text-xs bg-blue-100 text-blue-600 px-3 py-1 rounded-full">
                        Akan Datang
                    </span>
                </div>

                <div class="space-y-2 text-sm text-gray-600">
                    <div class="flex items-center gap-2">📍 Lab Komputer 1</div>
                    <div class="flex items-center gap-2">📅 Sabtu, 15 Februari 2025</div>
                    <div class="flex items-center gap-2">⏰ 09.00 – 11.00</div>
                    <div class="flex items-center gap-2">👤 Dr. Ahmad Fauzi</div>
                </div>
            </div>

            <!-- CARD 2 -->
            <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="font-semibold text-gray-800">
                        Seminar Nasional Matematika
                    </h3>
                    <span class="text-xs bg-green-100 text-green-600 px-3 py-1 rounded-full">
                        Berlangsung
                    </span>
                </div>

                <div class="space-y-2 text-sm text-gray-600">
                    <div class="flex items-center gap-2">📍 Ruang Seminar A</div>
                    <div class="flex items-center gap-2">📅 Sabtu, 15 Februari 2025</div>
                    <div class="flex items-center gap-2">⏰ 13.00 – 15.00</div>
                    <div class="flex items-center gap-2">👤 Prof. Sri Wahyuni</div>
                </div>
            </div>

            <!-- CARD 3 -->
            <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="font-semibold text-gray-800">
                        Kuliah Tamu Data Science
                    </h3>
                    <span class="text-xs bg-blue-100 text-blue-600 px-3 py-1 rounded-full">
                        Akan Datang
                    </span>
                </div>

                <div class="space-y-2 text-sm text-gray-600">
                    <div class="flex items-center gap-2">📍 Ruang Kelas 301</div>
                    <div class="flex items-center gap-2">📅 Minggu, 16 Februari 2025</div>
                    <div class="flex items-center gap-2">⏰ 08.00 – 10.00</div>
                    <div class="flex items-center gap-2">👤 Dr. Budi Santoso</div>
                </div>
            </div>

            <!-- CARD 4 -->
            <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="font-semibold text-gray-800">
                        Workshop React & TypeScript
                    </h3>
                    <span class="text-xs bg-blue-100 text-blue-600 px-3 py-1 rounded-full">
                        Akan Datang
                    </span>
                </div>

                <div class="space-y-2 text-sm text-gray-600">
                    <div class="flex items-center gap-2">📍 Lab Komputer 2</div>
                    <div class="flex items-center gap-2">📅 Minggu, 16 Februari 2025</div>
                    <div class="flex items-center gap-2">⏰ 13.00 – 15.00</div>
                    <div class="flex items-center gap-2">👤 Tim IT FMIPA</div>
                </div>
            </div>

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
            <div class="bg-white border border-gray-200 rounded-xl p-6 text-center shadow-sm hover:shadow-md transition">
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
            <div class="bg-white border border-gray-200 rounded-xl p-6 text-center shadow-sm hover:shadow-md transition">
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
            <div class="bg-white border border-gray-200 rounded-xl p-6 text-center shadow-sm hover:shadow-md transition">
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
            <div class="bg-white border border-gray-200 rounded-xl p-6 text-center shadow-sm hover:shadow-md transition">
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
@endsection
