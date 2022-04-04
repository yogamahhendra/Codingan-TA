@extends('layouts.main')
@section('head')
@endsection
@section('content')
    <div class="mx-auto w-11/12 lg:w-10/12 laptopl:w-9/12">
        {{-- Penjelajahan --}}
        <div class="h-full pt-10">
            {{-- accordion --}}
            <form action="" method="GET">
                <div class="mb-3">
                    <p class="mb-2"><label class="font-semibold text-lg" for="penjelajahan">Penjelajahan</label></p>
                    <div class="flex">
                        <select class="w-max px-6 pb-1 h-10 rounded-md border-2 border-bali-400" name="penjelajahan"
                            id="penjelajahan">
                            <option value="" disabled selected>Jelajahi berdasarkan</option>
                            <option value="tingkatan" {{ $value === 'tingkatan' ? 'selected' : '' }}>Tingkatan Bahasa</option>
                            <option value="bentuk" {{ $value === 'bentuk' ? 'selected' : '' }}>Bentuk Kata</option>
                            <option value="kategori"  {{ $value === 'kategori' ? 'selected' : '' }}>Kategori Kata</option>
                        </select>
                        <div class="flex ml-5 gap-4">
                            <button class="bg-bali-200 py-2 px-6 hover:bg-bali-300 text-bali-700 rounded-md" type="submit"
                                name="cari" value="cari">Cari</button>
                            {{-- <button class="bg-bali-600 py-2 px-6 hover:bg-bali-500 text-bali-100 rounded-md" type="submit"
                                name="reset" value="reset">Reset</button> --}}
                        </div>
                    </div>
                </div>
            </form>
            <div class="bg-gray-50 flex">
                <div class="">
                    <div class="w-full mx-auto z-0">
                        <ul class="shadow-box">
                            {{-- bali sor --}}
                            @foreach ($penjelajahan as $key => $value)
                            <li class="relative" x-data="{ selected: 1 }">
                                <button type="button" class="w-max  py-4 text-left "
                                    @click="selected !== 1 ? selected = 1 : selected = null">
                                    <div class="flex items-center justify-between text-bali-500 ">
                                        <span :class="selected == 1 ? 'fa-chevron-down' : 'fa-chevron-right'"
                                            class="fas"></span>
                                        <span class=" ml-3 text-bali-500 text-sm md:text-base font-bold">
                                            {{ $key }} </span>
                                    </div>
                                </button>
                                <div class="relative overflow-hidden transition-all max-h-0 duration-700 ml-6 bg-white text-black"
                                    style="" x-ref="container1"
                                    x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                                    <ul class="listSearch">
                                        <div
                                            class="p-6 grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-7 gap-y-10 text-sm md:text-base">
                                            @foreach ($value as $item)
                                                <a class="w-max transition ease-in-out hover:translate-x-0 hover:scale-105 duration-75 hover:text-bali-500  hover:font-semibold"
                                                    href="/detail/{{ $item}}">{{ ucfirst(strstr($item, '.', true)) }}</a>
                                            @endforeach
                                        </div>
                                    </ul>
                                </div>
                            </li>
                            @endforeach


                            {{-- hide --}}
                            <p class="invisible">b b b b b b b bb b bb b b b b b b b b b b b b b b b b b b b b b b b b
                                b b b b b b b b b b b bb bb bb b b b b b bb b b b b b b b b b b bb bb b b b b b b
                                b b b b b b b b b b b b b</p>


                        </ul>
                    </div>
                </div>
            </div>
            {{-- End Accordion --}}
        </div>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        $(document).ready(function($) {

            $('.listSearch p').each(function() {
                $(this).attr('searchData', $(this).text().toLowerCase());
            });
            $('.boxSearch').on('keyup', function() {
                var dataList = $(this).val().toLowerCase();
                $('.listSearch p').each(function() {
                    if ($(this).filter('[searchData *= ' + dataList + ']').length > 0 || dataList
                        .length < 1) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

        });
    </script>
@endsection
