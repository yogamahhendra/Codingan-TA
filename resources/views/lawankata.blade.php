<?php use App\Http\Controllers\levenshteinController; ?>
@extends('layouts.main')
@section('head')
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
@section('content')
    <div class="mx-auto w-11/12 lg:w-10/12 laptopl:w-9/12" data-aos="fade" data-aos-delay="200" data-aos-duration="700">
        <p class="mt-4 text-xl font-bold">Lawan Kata</p>
        <form action="" method="GET">
            <div class="hidden">
                @php
                    $j = count($data['listtingkatan']);
                @endphp
                <p class="mb-2 font-semibold text-bali-700 mt-6"><label class="" for="tingkatan">Tingkatan
                        Bahasa</label></p>
                <div class="grid grid-cols-11 gap-7">
                    <select class="js-example-basic-multiple mb-4 py-4 col-span-5 w-full" name="caritingkatan[]"
                        multiple="multiple">
                        @for ($i = 0; $i < $j; $i++)
                            <option value="{{ $data['listtingkatan'][$i] }}">
                                {{ $data['listtingkatan3'][$i] }}</option>
                        @endfor
                    </select>
                </div>
            </div>
            @if (isset($data['hasilkata']))
                <div class="flex mt-3 -mb-3">
                    <p class="">Apakah kata yang anda maksud&nbsp;</p>
                    <a href="lawankata?carilawan={{ pathinfo($data['hasilkata'], PATHINFO_FILENAME) }}&cari=cari"
                        class="font-extrabold text-blue-600 italic hover:underline">{{ pathinfo($data['hasilkata'], PATHINFO_FILENAME) }}</a>
                    <p class="">&nbsp;?</p>
                </div>
            @endif
            <div class="grid grid-cols-11 gap-7 mt-7">
                <div class="col-span-11 lg:col-span-5">
                    <textarea class="w-full px-3 py-2 rounded-md border-gray-700 border-2 h-28" name="carilawan" rows="4"
                        placeholder="Masukkan Kata"
                        cols="50">{{ isset($data['listkata'][0]['namakata']) ? pathinfo($data['listkata'][0]['namakata'], PATHINFO_FILENAME) : '' }}</textarea>
                    @if (isset($data['hasilkata']))
                        <div class="mt-3 -mb-3 p-5 bg-bali-50 border-bali-500 border-2">
                            <p class="text-lg font-semibold mb-2">Levenshtein Distance&nbsp;</p>
                            <div class="">
                                <p class="font-semibold mb-1"> Menghitungan Jarak Kata Inputan dengan kata yang
                                    memilikiLawanKata pada individu di Ontologi </p>
                                @php
                                    $count = count($data['listdistance']);
                                @endphp
                                @for ($i = 0; $i < $count; $i++)
                                    <div class="flex mb-3">
                                        <p>{{ $data['carilawan'] }} =>&nbsp;</p>
                                        <p>{{ pathinfo($data['listlawankata'][$i], PATHINFO_FILENAME) }} &nbsp;</p>
                                        <p>(Distance = {{ $data['listdistance'][$i] }})</p>
                                    </div>
                                @endfor
                                <div class="">
                                    <p class="font-semibold mt-5 mb-1"> Mencari Distance Terkecil (Max 2) </p>
                                    <p>{{ $data['carilawan'] }} => {{ pathinfo($data['hasilkata'], PATHINFO_FILENAME) }}
                                        (Distance = {{ $data['resultlvn']['distance'] }})&nbsp;</p>
                                </div>
                                <div class="">
                                    <p class="font-semibold mt-5 mb-1"> Detail Levenshtein Distance </p>
                                    <div class="">
                                        @php
                                            $datastatus = count($data['resultlvn']['status']);
                                        @endphp
                                        @for ($i = $datastatus - 1; $i >= 0; $i--)
                                            <div class="flex">
                                                <p class="w-4">{{ $data['resultlvn']['status'][$i][0] }}</p>
                                                <p class="w-10">&nbsp;=>&nbsp;</p>
                                                <p class="w-4">{{ $data['resultlvn']['status'][$i][2] }}&nbsp;</p>
                                                <p class="w-4"> ({{ $data['resultlvn']['status'][$i][1] }})</p>
                                            </div>
                                        @endfor
                                    </div>
                                    {{-- Matrix --}}
                                    <p class="font-semibold mt-5 mb-1"> Matrix </p>
                                    @php
                                        $str1Array = str_split($data['carilawan']);
                                        $str2Array = str_split(pathinfo($data['hasilkata'], PATHINFO_FILENAME));
                                        $str1 = count($str1Array);
                                        $str2 = count($str2Array);
                                    @endphp
                                    <div class="flex">
                                        <p class="w-6">&nbsp;</p>
                                        <p class="w-6">&nbsp;</p>
                                        @foreach ($str2Array as $item)
                                            <p class="w-6">{{ $item }}</p>
                                        @endforeach
                                    </div>

                                    <div class="flex">
                                        <div class="w-6">
                                            <p>&nbsp;</p>
                                            @foreach ($str1Array as $item)
                                                <p>{{ $item }}</p>
                                            @endforeach
                                        </div>
                                        @for ($i = 0; $i <= $str2; $i++)
                                            <div class="">
                                                @for ($j = 0; $j <= $str1; $j++)
                                                    <p class=w-6>{{ $data['resultlvn']['matrix'][$i][$j] }}</p>
                                                @endfor
                                            </div>
                                        @endfor
                                    </div>
                                </div>


                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-span-4 lg:col-span-1">
                    <button class="w-full bg-bali-600 py-1 hover:bg-bali-500 rounded-md text-bali-50" type="submit"
                        name="cari" value="cari"> Cari </button>
                </div>
                <div class="col-span-11 lg:col-span-5">
                    @if (isset($data['cari']))
                        @if ($data['kondisi'] === 0)
                            <div class="w-full bg-gray-300 border-gray-700 border-2 px-3 h-28 py-2 rounded-md">
                                <p>Mohon masukkan kata terlebih dahulu</p>
                            </div>
                        @elseif ($data['jumlahdata'] === 0)
                            <div class="w-full bg-gray-300 border-gray-700 border-2 px-3 h-28 py-2 rounded-md">
                                <p>Data tidak ditemukan</p>
                            </div>
                        @else
                            <div class="w-full bg-gray-300 border-gray-700 border-2 px-3 h-28 py-2 rounded-md">
                                <a class="hover:underline hover:font-semibold"
                                    href="/detail/{{ $data['listkata'][0]['lawankata'] }}">{{ pathinfo($data['listkata'][0]['lawankata'], PATHINFO_FILENAME) }}</a>
                            </div>
                            <p class="font-bold text-gray-600 mt-4">> Bahasa Indonesia</p>
                            <p>{{ pathinfo($data['listkata'][0]['terjemahankata'], PATHINFO_FILENAME) }}</p>
                        @endif
                    @else
                        <div class="w-full bg-gray-300 border-gray-700 border-2 px-3 h-28 py-2 rounded-md">
                        </div>
                    @endif
                </div>

            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                placeholder: "Pilih Tingkatan Bahasa"
            });
        });
    </script>
@endsection
