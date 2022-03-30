@extends('layouts.main')
@section('head')
@endsection
@section('content')
    <div class="mx-auto w-11/12 lg:w-10/12 laptopl:w-9/12">
        {{-- Penjelajahan --}}
        <div class="h-full pt-20">
            {{-- accordion --}}
            <div class="bg-gray-50 flex">
                <div class="">
                    <div class="w-full mx-auto z-0">
                        <ul class="shadow-box">
                            {{-- bali sor --}}
                            <li class="relative" x-data="{selected:1}">
                                <button type="button" class="w-max px-4 py-4 text-left "
                                    @click="selected !== 1 ? selected = 1 : selected = null">
                                    <div class="flex items-center justify-between text-bali-500 ">
                                        <span :class="selected == 1 ? 'fa-chevron-down' : 'fa-chevron-right'"
                                            class="fas"></span>
                                        <span class=" ml-3 text-bali-500 text-sm md:text-base font-bold">
                                            Bahasa Bali Alus Sor </span>
                                    </div>
                                </button>
                                <div class="relative overflow-hidden transition-all max-h-0 duration-700 ml-10 bg-white text-black"
                                    style="" x-ref="container1"
                                    x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                                    <ul class="listSearch">
                                        <div class="p-6 grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-7 gap-y-10 text-sm md:text-base">
                                            @foreach ($asor as $item)
                                        <a class="w-max transition ease-in-out hover:translate-x-0 hover:scale-105 hover:text-bali-500 duration-75 hover:font-semibold" href="/detail/{{ $item['kataalussor'] }}">{{ ucfirst(strstr($item['kataalussor'], '.', true)) }}</a>
                                            @endforeach
                                        </div>
                                    </ul>
                                </div>
                            </li>
                            {{-- bali singgih --}}
                            <li class="relative" x-data="{selected:2}">
                                <button type="button" class="w-max px-4 py-4 text-left "
                                    @click="selected !== 2 ? selected = 2 : selected = null">
                                    <div class="flex items-center justify-between text-bali-500 ">
                                        <span :class="selected == 2 ? 'fa-chevron-down' : 'fa-chevron-right'"
                                            class="fas"></span>
                                        <span class=" ml-3 text-bali-500 font-bold text-sm md:text-base">
                                            Bahasa Bali Alus Singgih </span>
                                    </div>
                                </button>
                                <div class="relative overflow-hidden transition-all max-h-0 duration-700 ml-10 bg-white text-black"
                                    style="" x-ref="container1"
                                    x-bind:style="selected == 2 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                                    <ul class="listSearch">
                                        <div class="p-6 grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-7 gap-y-10 text-sm md:text-base">
                                            @foreach ($asi as $item)
                                            <p class="w-max transition ease-in-out hover:translate-x-0 hover:scale-105 hover:text-bali-500 duration-75 hover:font-semibold"><a href="/detail/{{ $item['kataalussinggih'] }}">{{ strstr($item['kataalussinggih'],'.',true) }}</a></p>
                                            @endforeach
                                        </div>
                                    </ul>
                                </div>
                            </li>
                            {{-- bali mider --}}
                            <li class="relative" x-data="{selected:2}">
                                <button type="button" class="w-max px-4 py-4 text-left "
                                    @click="selected !== 2 ? selected = 2 : selected = null">
                                    <div class="flex items-center justify-between text-bali-500 ">
                                        <span :class="selected == 2 ? 'fa-chevron-down' : 'fa-chevron-right'"
                                            class="fas"></span>
                                        <span class=" ml-3 text-bali-500 font-bold text-sm md:text-base">
                                            Bahasa Bali Alus Mider </span>
                                    </div>
                                </button>
                                <div class="relative overflow-hidden transition-all max-h-0 duration-700 ml-10 bg-white text-black"
                                    style="" x-ref="container1"
                                    x-bind:style="selected == 2 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                                    <ul class="listSearch">
                                        <div class="p-6 grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-7 gap-y-10 text-sm md:text-base">
                                            @foreach ($ami as $item)
                                            <p class="w-max transition ease-in-out hover:translate-x-0 hover:scale-105 hover:text-bali-500 duration-75 hover:font-semibold"><a href="/detail/{{ $item['kataalusmider'] }}">{{ strstr($item['kataalusmider'],'.',true) }}</a></p>
                                            @endforeach
                                        </div>
                                    </ul>
                                </div>
                            </li>

                            {{-- Andap --}}
                            <li class="relative" x-data="{selected:2}">
                                <button type="button" class="w-max px-4 py-4 text-left "
                                    @click="selected !== 2 ? selected = 2 : selected = null">
                                    <div class="flex items-center justify-between text-bali-500 ">
                                        <span :class="selected == 2 ? 'fa-chevron-down' : 'fa-chevron-right'"
                                            class="fas"></span>
                                        <span class=" ml-3 text-bali-500 font-bold text-sm md:text-base">
                                            Bahasa Bali Andap </span>
                                    </div>
                                </button>
                                <div class="relative overflow-hidden transition-all max-h-0 duration-700 ml-10 bg-white text-black"
                                    style="" x-ref="container1"
                                    x-bind:style="selected == 2 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                                    <ul class="listSearch">
                                        <div class="p-6 grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-7 gap-y-10 text-sm md:text-base">
                                            @foreach ($andap as $item)
                                            <p class="w-max transition ease-in-out hover:translate-x-0 hover:scale-105 hover:text-bali-500 duration-75 hover:font-semibold"><a href="/detail/{{ $item['katabaliandap'] }}">{{ strstr($item['katabaliandap'],'.',true) }}</a></p>
                                            @endforeach
                                        </div>
                                    </ul>
                                </div>
                            </li>

                            {{-- Kasar --}}
                            <li class="relative" x-data="{selected:2}">
                                <button type="button" class="w-max px-4 py-4 text-left "
                                    @click="selected !== 2 ? selected = 2 : selected = null">
                                    <div class="flex items-center justify-between text-bali-500 ">
                                        <span :class="selected == 2 ? 'fa-chevron-down' : 'fa-chevron-right'"
                                            class="fas"></span>
                                        <span class=" ml-3 text-bali-500 font-bold text-sm md:text-base">
                                            Bahasa Bali Kasar </span>
                                    </div>
                                </button>
                                <div class="relative overflow-hidden transition-all max-h-0 duration-700 ml-10 bg-white text-black"
                                    style="" x-ref="container1"
                                    x-bind:style="selected == 2 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                                    <ul class="listSearch">
                                        <div class="p-6 grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-7 gap-y-10 text-sm md:text-base">
                                            @foreach ($kasar as $item)
                                            <p class="w-max transition ease-in-out hover:translate-x-0 hover:scale-105 hover:text-bali-500 duration-75 hover:font-semibold"><a href="/detail/{{ $item['katabalikasar'] }}">{{ strstr($item['katabalikasar'],'.',true) }}</a></p>
                                            @endforeach
                                        </div>
                                    </ul>
                                </div>
                            </li>
                           

                            {{-- hide --}}
                            <p class="invisible">b b b b b b b bb b bb b b b b b b b b b b b b b b b b b b b b b b b b
                                b b b b b b b b b b b bb bb bb b b b b b bb b b b b b b b b b b bb bb b b b b b b
                                b b b b b b b b b b b b b</p>
                            <p class="invisible">b b b b b b b bb b bb b b b b b b b b b b b b b b b b b b b b b b b b
                                b b b b b b b b b b b bb bb bb b b b b b bb b b b b b b b b b b bb bb b b b b b b
                                b b b b b b b b b b b b b</p>
                            <p class="invisible">b b b b b b b bb b bb b b b b b b b b b b b b b b b b b b b b b b b b
                                b b b b b b b b b b b bb bb bb b b b b b bb b b b b b b b b b b bb bb b b b b b b
                                b b b b b b b b b b b b b</p>
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
