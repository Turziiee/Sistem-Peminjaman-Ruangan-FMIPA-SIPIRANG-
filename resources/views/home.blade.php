@extends('layouts.app')

@section('content')

<div class="container mt-4">

    {{-- ================= HERO SLIDER ================= --}}
    <div id="heroCarousel" class="carousel slide mb-5" data-bs-ride="carousel">

        {{-- Indicator --}}
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3"></button>
        </div>

        {{-- Slides --}}
        <div class="carousel-inner rounded-4 overflow-hidden">

            @for ($i = 0; $i < 4; $i++)
            <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                <div class="hero-slide"
                     style="background-image: url('{{ asset('assets/dummy.JPG') }}')">

                    <div class="hero-overlay">
                        <h3 class="fw-bold">Ruang Rapat A</h3>
                        <p>Ruang rapat eksklusif untuk pertemuan formal dan diskusi kelompok</p>

                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="badge bg-dark bg-opacity-75">20 orang</span>
                            <span class="badge bg-dark bg-opacity-75">TV LED 55"</span>
                            <span class="badge bg-dark bg-opacity-75">AC</span>
                            <span class="badge bg-dark bg-opacity-75">Meja Rapat</span>
                        </div>

                        <a href="{{ url('/schedule') }}" class="btn btn-light btn-sm px-4 rounded-pill">
                            Lihat Detail & Jadwal
                        </a>
                    </div>

                </div>
            </div>
            @endfor

        </div>

        {{-- Arrow --}}
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>

    </div>
    {{-- ================= END HERO ================= --}}

    {{-- ================= CTA ================= --}}
    <div class="bg-dark text-white rounded-4 p-4 mb-5 d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-1">Siap Meminjam Ruangan?</h5>
            <small>Login atau daftar untuk mengajukan peminjaman ruangan sekarang</small>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ url('/login') }}" class="btn btn-light rounded-pill">Login Sekarang</a>
            <a href="{{ url('/schedule') }}" class="btn btn-outline-light rounded-pill">Lihat Jadwal</a>
        </div>
    </div>

    {{-- ================= JADWAL MENDATANG ================= --}}
    <h5 class="mb-3">Jadwal Mendatang</h5>
    <div class="row g-3 mb-5">
        @for ($i = 0; $i < 4; $i++)
        <div class="col-md-6">
            <div class="border rounded-4 p-3 h-100">
                <strong>Praktikum Algoritma</strong>
                <div class="text-muted small">Lab Komputer 1</div>
                <div class="text-muted small">15 Februari 2025 • 09.00 - 11.00</div>
                <span class="badge bg-primary mt-2">Akan Datang</span>
            </div>
        </div>
        @endfor
    </div>

    {{-- ================= KEUNGGULAN ================= --}}
    <h5 class="text-center mb-4">Keunggulan Sistem</h5>
    <div class="row g-4 mb-5 text-center">
        <div class="col-md-3">
            <div class="border rounded-4 p-3 h-100">
                <strong>Sistem Terintegrasi</strong>
                <p class="small text-muted mt-2">Penjadwalan terpusat dan real-time</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="border rounded-4 p-3 h-100">
                <strong>Pilihan Ruangan</strong>
                <p class="small text-muted mt-2">Lab, kelas, seminar, rapat</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="border rounded-4 p-3 h-100">
                <strong>Multi User</strong>
                <p class="small text-muted mt-2">Mahasiswa, dosen, admin</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="border rounded-4 p-3 h-100">
                <strong>Persetujuan Cepat</strong>
                <p class="small text-muted mt-2">Online & transparan</p>
            </div>
        </div>
    </div>

</div>

@endsection
