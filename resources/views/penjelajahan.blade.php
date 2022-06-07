@extends('layouts.main')
@section('head')
@endsection
@section('content')
    <div class="mx-auto w-11/12 lg:w-10/12 laptopl:w-9/12">
        <div class="h-full pt-10">
            {{-- accordion --}}
            <p class="mb-2 font-bold text-2xl">Penjelajahan</p>
            @if (isset($listclass))
                <p class="mt-6 font-bold">Jelajahi Berdasarkan : </p>
                @foreach ($listclass as $item)
                    <div class="flex mt-2">
                        <p class="items-center justify-between text-bali-400 fa-chevron-right fas mt-1"><a
                                href="/penjelajahan/{{ str_replace(' ', '', $item) }}" class="hover:underline">
                                <p class="ml-3 text-bali-600 text-sm md:text-base font-bold text-xl">{{ $item }}<p>
                            </a></p>
                    </div>
                @endforeach
            @elseif(isset($individual))
                @if ($class == 'Tingkatan Bahasa')
                    <p class="mt-6 font-bold">Menjelajahi Bahasa Bali
                        {{ trim(preg_replace('/(?<=\\w)(?=[A-Z])/', ' ', $individual)) }} dalam {{ $class }}</p>
                    {{--  --}}
                    <ul class="shadow-box">
                        <li class="relative" x-data="{ selected: 1 }">
                            <button type="button" class="w-max  py-4 text-left "
                                @click="selected !== 1 ? selected = 1 : selected = null">
                                <div class="flex items-center justify-between text-bali-500 ">
                                    <span :class="selected == 1 ? 'fa-chevron-down' : 'fa-chevron-right'"
                                        class="fas"></span>
                                    <span class=" ml-3 text-bali-500 text-sm md:text-base font-bold">Bahasa Bali
                                        {{ trim(preg_replace('/(?<=\\w)(?=[A-Z])/', ' ', $individual)) }} </span>
                                </div>
                            </button>
                            <div class="relative overflow-hidden transition-all max-h-0 duration-700 bg-white text-black"
                                style="" x-ref="container1"
                                x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                                <ul class="listSearch">
                                    <div
                                        class="p-6 grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-7 gap-y-10 text-sm md:text-base">
                                        @foreach ($paginationkata as $item)
                                            <a class="w-max transition ease-in-out hover:translate-x-0 hover:scale-105 duration-75 hover:text-bali-500  hover:font-semibold"
                                                href="/detail/{{ $item }}">{{ ucfirst(strstr($item, '.', true)) }}</a>
                                        @endforeach
                                    </div>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <div class="mt-4">
                        @if (count($data) > 30)
                            {{ $paginationkata->links('pagination::tailwind') }}
                        @endif
                    </div>
                @else
                    <p class="mt-6 font-bold">Menjelajahi {{ ucwords(str_replace('_', ' ', $individual)) }} dalam
                        {{ $class }}</p>
                        <ul class="shadow-box">
                            <li class="relative" x-data="{ selected: 1 }">
                                <button type="button" class="w-max  py-4 text-left "
                                    @click="selected !== 1 ? selected = 1 : selected = null">
                                    <div class="flex items-center justify-between text-bali-500 ">
                                        <span :class="selected == 1 ? 'fa-chevron-down' : 'fa-chevron-right'"
                                            class="fas"></span>
                                        <span class=" ml-3 text-bali-500 text-sm md:text-base font-bold">
                                            {{ ucwords(str_replace('_', ' ', $individual)) }} </span>
                                    </div>
                                </button>
                                <div class="relative overflow-hidden transition-all max-h-0 duration-700 bg-white text-black"
                                    style="" x-ref="container1"
                                    x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                                    <ul class="listSearch">
                                        <div
                                            class="p-6 grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-x-7 gap-y-10 text-sm md:text-base">
                                            @foreach ($paginationkata as $item)
                                                <a class="w-max transition ease-in-out hover:translate-x-0 hover:scale-105 duration-75 hover:text-bali-500  hover:font-semibold"
                                                    href="/detail/{{ $item }}">{{ ucfirst(strstr($item, '.', true)) }}</a>
                                            @endforeach
                                        </div>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <div class="mt-4">
                            @if (count($data) > 30)
                                {{ $paginationkata->links('pagination::tailwind') }}
                            @endif
                        </div>
                @endif
            @elseif (isset($data))
                <p class="mt-6 font-bold">Menjelajahi Berdasarkan {{ $class }}</p>
                <p class="mt-3 font-semibold">Pilih {{ $class }}:</p>
                @if ($class == 'Tingkatan Bahasa')
                    @foreach ($data as $item)
                        <div class="flex mt-2">
                            <p class="items-center justify-between text-bali-400 fa-chevron-right fas mt-1"><a
                                    href="/penjelajahan/{{ str_replace(' ', '', $class) }}/{{ strtr($item, [' ' => '', 'Bahasa Bali' => '']) }}"
                                    class="hover:underline">
                                    <p class="ml-3 text-bali-600 text-sm md:text-base font-bold text-xl">
                                        {{ $item }}
                                        <p>
                                </a></p>
                        </div>
                    @endforeach
                @else
                    @foreach ($data as $item)
                        <div class="flex mt-2">
                            <p class="items-center justify-between text-bali-400 fa-chevron-right fas mt-1"><a
                                    href="/penjelajahan/{{ str_replace(' ', '', $class) }}/{{ $item }}"
                                    class="hover:underline">
                                    <p class="ml-3 text-bali-600 text-sm md:text-base font-bold text-xl">
                                        {{ ucwords(str_replace('_', ' ', $item)) }}
                                        <p>
                                </a></p>
                        </div>
                    @endforeach
                @endif
            @endif
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
