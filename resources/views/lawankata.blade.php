@extends('layouts.main')
@section('head')
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
@section('content')
    <div class="mx-auto w-9/12">
        <p class="mt-4 text-xl font-bold">Lawan Kata</p>
        <form action="">
            <div class="">
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
            <div class="grid grid-cols-11 gap-7 mt-7">
                <div class="col-span-5">
                    <textarea class="w-full px-3 py-2 rounded-md border-gray-700 border-2 h-28" name="carilawan" rows="4"
                        placeholder="Masukkan Kata"
                        cols="50">{{ isset($data['listkata'][0]['namakata']) ? pathinfo($data['listkata'][0]['namakata'], PATHINFO_FILENAME) : '' }}</textarea>
                </div>
                <div class="col-span-1">
                    <button class="w-full bg-bali-600 py-1 hover:bg-bali-500 rounded-md text-bali-50" type="submit"
                        name="cari" value="cari"> Cari </button>
                </div>
                <div class="col-span-5">
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
                                <p>{{ pathinfo($data['listkata'][0]['lawankata'], PATHINFO_FILENAME) }}</p>
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
