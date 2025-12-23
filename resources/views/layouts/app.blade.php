<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIPIRANG FMIPA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- Bootstrap 5 CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="/">
            <i class="bi bi-building"></i> SIPIRANG FMIPA
        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="navMenu" class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto gap-3">
                <li class="nav-item"><a class="nav-link active" href="/">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="/schedule">Jadwal</a></li>
                <li class="nav-item"><a class="nav-link" href="/faq">FAQ</a></li>
                <li class="nav-item"><a class="nav-link" href="/contact">Kontak</a></li>
                <li class="nav-item"><a class="btn btn-dark px-3" href="/login">Login</a></li>
            </ul>
        </div>
    </div>
</nav>

{{-- CONTENT --}}
<main class="py-4">
    @yield('content')
</main>

{{-- FOOTER --}}
<footer class="bg-dark text-white mt-5">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-4">
                <h5>SIPIRANG FMIPA</h5>
                <p class="small">
                    Sistem Peminjaman Ruangan<br>
                    Fakultas Matematika dan Ilmu Pengetahuan Alam
                </p>
            </div>

            <div class="col-md-4">
                <h6>Menu</h6>
                <ul class="list-unstyled small">
                    <li>Ruangan</li>
                    <li>Jadwal</li>
                    <li>FAQ</li>
                    <li>Kontak</li>
                </ul>
            </div>

            <div class="col-md-4">
                <h6>Kontak</h6>
                <p class="small mb-1">Email: admin.fmipa@university.ac.id</p>
                <p class="small">Jam Operasional: 08.00 – 16.00</p>
            </div>
        </div>

        <hr class="border-secondary">
        <p class="text-center small mb-0">© 2025 SIPIRANG FMIPA</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
