@auth
<header class="bg-[#3A3A3A] text-white">
    <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">

        <!-- LOGO -->
        <a href="{{ auth()->check() && auth()->user()->role === 'admin' ? '/admin/dashboard' : '/dashboard' }}" class="flex items-center gap-3">
            <div class="w-9 h-9 bg-white/10 rounded-lg flex items-center justify-center">
                🏢
            </div>
            <div>
                <div class="font-semibold">SIPIRANG FMIPA</div>
                <div class="text-xs text-gray-300">
                    {{ strtoupper(auth()->user()->role) }}
                </div>
            </div>
        </a>

        <!-- MENU -->
        <nav class="flex gap-6 items-center text-sm font-medium">

            {{-- USER --}}
            @if (auth()->user()->role === 'user')
                @php
                    $active = 'bg-white/10 shadow rounded-lg px-3 py-1';
                @endphp

                <a href="/dashboard" class="{{ request()->is('dashboard') ? $active : '' }}">
                    Beranda
                </a>

                <a href="/room-catalog" class="{{ request()->is('room-catalog*') ? $active : '' }}">
                    Ruangan
                </a>

                <a href="/my-bookings" class="{{ request()->is('my-bookings') ? $active : '' }}">
                    Status
                </a>

                <a href="/faq" class="{{ request()->is('faq') ? $active : '' }}">
                    FAQ
                </a>

                <a href="/contact" class="{{ request()->is('contact') ? $active : '' }}">
                    Kontak
                </a>
            @endif

            {{-- ADMIN --}}
            @if (auth()->user()->role === 'admin')
                <a href="/admin/dashboard" class="hover:text-gray-300">Beranda</a>
                <a href="/admin/rooms" class="hover:text-gray-300">Ruangan</a>
                <a href="/admin/bookings" class="hover:text-gray-300">Permintaan</a>
                <a href="/admin/faqs" class="hover:text-gray-300">FAQ</a>
                <a href="/admin/contact" class="hover:text-gray-300">Kontak</a>
            @endif

            <!-- LOGOUT -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg">
                    Log Out
                </button>
            </form>
        </nav>

    </div>
</header>
@endauth
