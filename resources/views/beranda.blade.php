@extends('layouts.main')
@section('head')
@endsection
@section('content')
    <div class="mx-auto w-11/12 lg:w-10/12 laptopl:w-9/12 my-14 md:mb-0  md:mt-10 lg:-mt-3 laptopl:-mt-20" data-aos="fade"
        data-aos-delay="200" data-aos-duration="900">
        <div class="grid grid-grid-cols-1 md:grid-cols-2 gap-7 h-full">
            <div class="hidden md:inline h-3/4 my-auto">
                <img class="w-full h-full object-center object-cover rounded-lg shadow-xl"
                    src="{{ asset('images/beranda.jpg') }}">
            </div>
            <div class="h-max my-auto" data-aos="fade-left" data-aos-delay="200" data-aos-duration="800">
                <p class="font-bold text-xl text-bali-400">Selamat Datang di Sistem Informasi Bahasa Bali</p>
                <p class="font-medium text-lg mt-2" style="font-family: Vimala;">ᬲᬮᬫᬢ᭄ᬤᬢᬂᬤᬶᬲᬶᬲ᭄ᬢᭂᬫ᭄ᬳᬶᬦ᭄ᬧᭀᬭ᭄ᬫᬲᬶᬩᬳᬲᬩᬮᬶ᭟</p>
                <p class="hidden md:inline-block">-</p>
                <div class="md:hidden inline h-1/2 my-auto">
                    <img class="w-full h-72 mt-6 mb-5 object-top md:object-center object-cover rounded-lg shadow-sm"
                        src="{{ asset('images/beranda.jpg') }}">
                </div>
                <p class="text-justify text-gray-700 text-sm">Selamat Datang di Sistem Informasi Bahasa Bali, Sistem ini memberikan informasi Pengetahuan Kata pada Bahasa Bali. Sistem ini memiliki 3 Fungsi Utama yaitu Penjelajahan, Pencarian dan Lawan Kata. Dapat diklik pada button dibawah ini :</p>
                <div class="hidden lg:flex flex-row gap-3 mt-5 w-max">
                    <div>
                        <button onclick="location.href='/penjelajahan'" tyoe="button"
                            class="w-max rounded-md bg-orange-100 text-sm font-semibold text-orange-700 px-4 py-2 transition ease-in-out hover:translate-x-0 hover:scale-105 duration-75 hover:bg-orange-200">Penjelajahan</button>
                    </div>
                    <div class="">
                        <button onclick="location.href='/pencarian'" tyoe="button"
                            class="w-max rounded-md bg-lime-100 text-lime-700 text-sm font-semibold px-4 py-2 transition ease-in-out hover:translate-x-0 hover:scale-105 duration-75 hover:bg-lime-200">Pencarian</button>
                    </div>
                    <div class="">
                        <button onclick="location.href='/lawankata'" tyoe="button"
                            class="w-max rounded-md bg-teal-100 text-teal-700 text-sm font-semibold px-4 py-2 transition ease-in-out hover:translate-x-0 hover:scale-105 duration-75 hover:bg-teal-200">Lawan
                            Kata</button>

                    </div>
                </div>
                <div class="grid grid-cols-3 md:grid-cols-2 lg:hidden gap-3 mt-5">
                    <div>
                        <button onclick="location.href='/penjelajahan'" tyoe="button"
                            class="w-full rounded-md bg-orange-100 text-sm font-semibold text-orange-700 px-4 py-2 transition ease-in-out hover:translate-x-0 hover:scale-105 duration-75 hover:bg-orange-200">Penjelajahan</button>
                    </div>
                    <div class="">
                        <button onclick="location.href='/pencarian'" tyoe="button"
                            class="w-full rounded-md bg-lime-100 text-lime-700 text-sm font-semibold px-4 py-2 transition ease-in-out hover:translate-x-0 hover:scale-105 duration-75 hover:bg-lime-200">Pencarian</button>
                    </div>
                    <div class="">
                        <button onclick="location.href='/lawankata'" tyoe="button"
                            class="w-full rounded-md bg-teal-100 text-teal-700 text-sm font-semibold px-4 py-2 transition ease-in-out hover:translate-x-0 hover:scale-105 duration-75 hover:bg-teal-200">Lawan
                            Kata</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
