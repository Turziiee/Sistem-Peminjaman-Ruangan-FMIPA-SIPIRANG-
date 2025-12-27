@extends('layouts.guest')

@section('page')
            <!-- HEADER -->
            <div class="mb-8">
                <div class="flex items-center gap-2 text-gray-700 mb-1">
                    <span class="text-xl">❓</span>
                    <h1 class="text-xl font-semibold">Frequently Asked Questions</h1>
                </div>
                <p class="text-gray-500 text-sm">
                    Temukan jawaban untuk pertanyaan yang sering diajukan
                </p>
            </div>


            <!-- FAQ LIST -->
            @foreach ($faqs as $faq)
                <details class="bg-white border border-gray-200 rounded-lg mb-3">
                    <summary class="cursor-pointer px-6 py-4 flex justify-between items-center font-medium text-gray-800">
                        {{ $faq->question }}
                        <span class="transition-transform group-open:rotate-180">
                            ▼
                        </span>
                    </summary>

                    <div class="px-6 pb-4 text-gray-600 text-sm leading-relaxed">
                        {{ $faq->answer }}
                    </div>
                </details>
            @endforeach


            <!-- CONTACT BOX -->
            <div class="mt-10 bg-gray-50 border border-gray-200 rounded-lg p-6">
                <p class="font-medium mb-1">
                    Tidak menemukan jawaban yang Anda cari?
                </p>
                <p class="text-gray-500 mb-4 text-sm">
                    Hubungi admin kami untuk pertanyaan lebih lanjut
                </p>
                <a href="{{ route('contact.index') }}" class="inline-block bg-[#4F4F4F] text-white px-5 py-2 rounded-lg">
                    Kontak Admin
                </a>
            </div>


@endsection
