@extends('layouts.auth')

@section('page')

<div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">

    <!-- LOGO -->
    <a href="/" class="flex flex-col items-center mb-6">
        <img src="{{ asset('assets/logofmipa.png') }}" alt="Logo FMIPA" class="w-25 h-25 object-contain">
        <div class="mt-2 font-semibold text-gray-700">
            SIPIRANG FMIPA
        </div>
        <div class="text-sm text-gray-500">
            Sistem Penjadwalan Ruangan FMIPA
        </div>
    </a>

    <!-- FORM REGISTER -->
    <form method="POST" action="{{ route('register.store') }}" class="space-y-5">
        @csrf

        <div>
            <label class="text-sm text-gray-600">Nama Lengkap</label>
            <input type="text" name="name"
                   class="w-full mt-1 px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-400"
                   placeholder="Masukkan nama" required>
        </div>

        <div>
            <label class="text-sm text-gray-600">Email</label>
            <input type="email" name="email"
                   class="w-full mt-1 px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-400"
                   placeholder="Masukkan email" required>
        </div>

        <div>
            <label class="text-sm text-gray-600">Password</label>
            <input type="password" name="password"
                   class="w-full mt-1 px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-gray-400"
                   placeholder="Masukkan password" required>
        </div>

        <button type="submit"
                class="w-full bg-[#4F4F4F] text-white py-3 rounded-xl hover:bg-gray-700 transition">
            Register
        </button>
    </form>

    <div class="text-center text-sm text-gray-500 mt-6">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-gray-700 font-medium hover:underline">
            Login di sini
        </a>
    </div>

</div>

@endsection
