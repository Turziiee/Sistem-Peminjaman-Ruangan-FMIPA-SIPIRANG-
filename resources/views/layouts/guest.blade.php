@extends('layouts.base')

@section('content')
    <!-- NAVBAR -->
    @if (auth()->check())
        @include('partials.navbar-auth')
    @else
        <header class="bg-[#F3F3F3] border-b border-gray-200 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex items-center justify-between h-16">

                    <!-- Logo -->
                    <div class="flex items-center gap-2 font-semibold">
                        <div class="w-9 h-9 bg-gray-700 rounded-lg flex items-center justify-center text-white">
                            🏢
                        </div>
                        <div>
                            <div>SIPIRANG FMIPA</div>
                            <div class="text-xs text-gray-500">Sistem Peminjaman Ruangan</div>
                        </div>
                    </div>

                    <!-- Menu Tengah -->
                    <nav class="flex items-center justify-center gap-6 h-16">
                        @php
                            $active = 'bg-[#3A3A3A] text-white shadow-md rounded-lg px-4 py-2';
                        @endphp
                        <a href="/" class="{{ request()->is('/') ? $active : '' }}">Beranda</a>
                        <a href="/rooms" class="{{ request()->is('rooms*') ? $active : '' }}">Ruangan</a>
                        <a href="/schedule" class="{{ request()->is('schedule*') ? $active : '' }}">Jadwal</a>
                        <a href="/faq" class="{{ request()->is('faq') ? $active : '' }}">FAQ</a>
                        <a href="/contact" class="{{ request()->is('contact') ? $active : '' }}">Kontak</a>
                    </nav>

                    <!-- Login -->
                    <a href="/login" class="bg-[#4F4F4F] text-white px-4 py-2 rounded-lg hover:bg-[#3A3A3A] transition">
                        Login →
                    </a>

                </div>
            </div>
        </header>
    @endif

    <!-- PAGE CONTENT -->
    <main class="max-w-7xl mx-auto px-6 py-8">
        @yield('page')
    </main>

    <!-- FOOTER -->
    <!-- FOOTER -->
    <footer class="bg-[#3A3A3A] text-[#D1D1D1] mt-20">
        <div class="max-w-7xl mx-auto px-6 py-12">

            <div class="grid grid-cols-3 gap-10 text-sm">

                <!-- Brand -->
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-9 h-9 bg-[#4F4F4F] rounded-lg flex items-center justify-center text-white">
                            🏢
                        </div>
                        <div class="font-semibold text-white">
                            SIPIRANG FMIPA
                        </div>
                    </div>

                    <p class="text-gray-300 leading-relaxed">
                        Sistem Peminjaman Ruangan<br>
                        Fakultas Matematika dan Ilmu Pengetahuan Alam
                    </p>
                </div>

                <!-- Menu -->
                <div>
                    <div class="font-semibold text-white mb-3">
                        Menu
                    </div>
                    <ul class="space-y-2">
                        <li><a href="/" class="hover:text-white">Beranda</a></li>
                        <li><a href="/rooms" class="hover:text-white">Ruangan</a></li>
                        <li><a href="/schedule" class="hover:text-white">Jadwal</a></li>
                        <li><a href="/faq" class="hover:text-white">FAQ</a></li>
                        <li><a href="/contact" class="hover:text-white">Kontak</a></li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div>
                    <div class="font-semibold text-white mb-3">
                        Kontak
                    </div>
                    <div class="space-y-2">
                        <p>Email: admin.fmipa@university.ac.id</p>
                        <p>Jam Operasional: 08.00 – 16.00</p>
                    </div>
                </div>

            </div>

            <!-- Divider -->
            <div class="border-t border-white/10 mt-10 pt-6 text-center text-xs text-gray-400">
                © 2025 SIPIRANG FMIPA — Fakultas MIPA
            </div>

        </div>
    </footer>
@endsection
