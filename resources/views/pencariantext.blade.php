@php
$i = 0;
@endphp
@extends('layouts.main')
@section('head')
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
@section('content')
    <div class="mx-auto w-11/12 lg:w-10/12 laptopl:w-9/12" data-aos="fade" data-aos-delay="200" data-aos-duration="700">
        <div class="flex mt-4">
            <div
                class="hover:bg-bali-500 hover:text-bali-50 bg-bali-100 text-bali-500 py-2 px-4 rounded-t-md{{ $title === 'Pencarian' ? ' bg-bali-500 text-bali-100 font-semibold' : '' }}">
                <a href="/pencarian" class="mt-4">Pencarian Kriteria</a>
            </div>
            <div
                class="ml-1 hover:bg-bali-500 hover:text-bali-50 bg-bali-100 text-bali-500 py-2 px-4 rounded-t-md{{ $title === 'Pencarian Text' ? ' bg-bali-500 text-bali-100 font-semibold' : '' }}">
                <a href="/pencariantext" class="mt-4">Pencarian Text</a>
            </div>
        </div>
        <form action="" method="GET">
            <div class="flex w-full mt-5">
                <div class="input-group relative flex w-full mb-4">
                    <input type="text"
                        class="form-control relative block w-10/12 px-3 py-1.5 text-base text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        placeholder="Search" aria-label="Search" aria-describedby="button-addon2" name="cariText">
                    <button
                        class="ml-2 btn px-6 py-2.5 bg-bali-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700  focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex items-center"
                        type="submit" value="cari" id="cari" name="cari">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search"
                            class="w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        </form>
        @if (isset($cari))
            @if ($kondisi == 0)
                <p class="font-semibold text-lg mt-6"> Masukkan kata pencarian terlebih dahulu </p>
            @elseif ($kondisi == 1)
                @if ($jumlah == 0)
                    @if (isset($hasilkata))
                        <p class="font-semibold">Apakah kata yang anda maksud <a
                                href="pencariantext?cariText={{ pathinfo($hasilkata, PATHINFO_FILENAME) }}&cari=cari"
                                class="font-bold italic text-blue-600 hover:underline">{{ pathinfo($hasilkata, PATHINFO_FILENAME) }}?</a>
                        </p>
                    @else
                        <p class="font-semibold text-lg text-red-600 mt-6">Data tidak ditemukan</p>
                    @endif
                @else
                    <div class="grid grid-cols-2 lg:grid-cols-3 mt-8 mb-10">
                        <div class="col-span-2">
                            <div class="grid grid-cols-2 gap-7 px-4 py-1 font-semibold bg-bali-600 text-bali-50">
                                <div>
                                    <p>Kata</p>
                                </div>
                                <div>
                                    <p>Tingkatan Bahasa</p>
                                </div>
                            </div>
                            <div class="">
                                @php
                                    
                                @endphp
                                @foreach ($paginationkata as $item)
                                    <div
                                        class="grid grid-cols-2 gap-7 px-4 py-2 {{ $i % 2 == 0 ? 'bg-bali-50' : 'bg-bali-100' }}">
                                        <div>
                                            <p><a class="hover:font-semibold"
                                                    href="/detail/{{ $item['kata'] }}">{{ ucfirst(pathinfo($item['kata'], PATHINFO_FILENAME)) }}
                                                </a></p>
                                        </div>
                                        <div>
                                            <p> {{ $item['tingkatan'] }} </p>
                                        </div>
                                        @php
                                            $i++;
                                        @endphp
                                    </div>
                                @endforeach
                                <div class="mt-4">
                                    @if (count($hasil) > 12)
                                        {{ $paginationkata->links('pagination::tailwind') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-span-2 mt-10 lg:mt-0 lg:col-span-1 lg:ml-4 px-4 py-4 rounded-md bg-gray-300 w-full h-max">
                            <p class="pl-4 font-semibold italic mb-2">Query :</p>
                            <p class="pl-4 font-semibold">{{ $query }}</p>
                        </div>
                    </div>
                @endif
            @endif
        @endif

    </div>
@endsection

@section('script')
@endsection
