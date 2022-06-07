@extends('layouts.main')
@section('head')
@endsection
@section('content')
    <div class="mx-auto md:w-9/12">
        <div class="flex justify-center inset-x-0 fixed z-10 mt-4">
            <div class="mb-3 xl:w-96">
                <div class="input-group relative flex flex-row items-stretch w-full mb-4 rounded">
                    <input
                        class="boxSearch form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-bali-500 focus:border-2 focus:outline-none"
                        placeholder="Masukkan Kata" aria-label="Search" aria-describedby="button-addon2">
                    <span
                        class="input-group-text flex items-center px-3 py-1.5 text-base font-normal text-gray-700 text-center whitespace-nowrap rounded"
                        id="basic-addon2">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" class="w-4"
                            role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="gray"
                                d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                            </path>
                        </svg>
                    </span>
                </div>
            </div>
        </div>
        <div class="h-full pt-20 bg-gray-50">
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
                                        <span class=" ml-3 text-bali-500 font-bold">
                                            Bahasa Bali Alus Sor </span>
                                    </div>
                                </button>
                                <div class="relative overflow-hidden transition-all max-h-0 duration-700 ml-10 bg-white text-black"
                                    style="" x-ref="container1"
                                    x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                                    <ul class="listSearch">
                                        <div class="p-6 grid grid-cols-5 gap-x-7 gap-y-10">

                                            <p class="hover:text-bali-500 hover:font-bold"><a href="/detail/panyingakan.ami">Panyingakan</a></p>
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
                                        <span class=" ml-3 text-bali-500 font-bold">
                                            Bahasa Bali Alus Singgih </span>
                                    </div>
                                </button>
                                <div class="relative overflow-hidden transition-all max-h-0 duration-700 ml-10 bg-white text-black"
                                    style="" x-ref="container1"
                                    x-bind:style="selected == 2 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                                    <ul class="listSearch">
                                        <div class="p-6 grid grid-cols-5 gap-x-7 gap-y-10">

                                            <p class="hover:text-bali-500 hover:font-bold"><a href="#">Panyingakan</a></p>
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
