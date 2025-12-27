@extends('layouts.guest')

@section('page')
    <div class="grid grid-cols-3 gap-8">

        <!-- FORM KIRIM PESAN -->
        <div class="lg:col-span-2 bg-white border border-gray-200 rounded-xl shadow-sm p-8">

            <h2 class="text-xl font-semibold mb-1">Kontak Admin</h2>
            <p class="text-gray-500 mb-6">
                Hubungi kami jika Anda memiliki pertanyaan atau masalah
            </p>

            <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium mb-1">Nama</label>
                    <input type="text" value="{{ auth()->user()->name }}" disabled
                        class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-3">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" value="{{ auth()->user()->email }}" disabled
                        class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-3">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Subjek</label>
                    <input type="text" name="subject"
                        class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-gray-400">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Pesan</label>
                    <textarea name="message" rows="5"
                        class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-gray-400"></textarea>
                </div>

                <button class="bg-[#4F4F4F] text-white px-6 py-3 rounded-lg hover:bg-[#3A3A3A]">
                    Kirim Pesan
                </button>
            </form>
        </div>


        <!-- INFORMASI KONTAK -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 flex flex-col min-h-[600px]">
            <h3 class="font-semibold mb-4 text-lg">Informasi Kontak</h3>

            <div class="space-y-4 text-sm text-gray-700">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-500 text-white rounded-lg flex items-center justify-center">✉️</div>
                    <span>admin.fmipa@university.ac.id</span>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-green-500 text-white rounded-lg flex items-center justify-center">📞</div>
                    <span>+62 123 4567 8900</span>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-red-500 text-white rounded-lg flex items-center justify-center">📍</div>
                    <span>Gedung FMIPA, Jl. Universitas No. 1</span>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-purple-500 text-white rounded-lg flex items-center justify-center">⏰</div>
                    <span>Senin – Jumat, 08:00 – 17:00</span>
                </div>
            </div>

            <div class="mt-auto bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                <h3 class="font-semibold mb-2 text-gray-800">Waktu Respons</h3>
                <p class="text-sm text-gray-600">
                    Admin akan merespons pesan Anda dalam waktu <strong>1×24 jam</strong>
                    pada hari kerja. Untuk pertanyaan mendesak, silakan hubungi melalui telepon.
                </p>
            </div>
        </div>


    </div>
@endsection
