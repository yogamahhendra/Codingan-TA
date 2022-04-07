@extends('layouts.main')
@section('head')
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
@section('content')
    <div class="mx-auto w-11/12 lg:w-10/12 laptopl:w-9/12" data-aos="fade" data-aos-delay="200" data-aos-duration="700">
        <p class="mt-7"><label class="font-semibold text-lg">Pencarian</label></p>
        <form action="" method="GET">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-10 h-full mt-6">
                <div class="">
                    @php
                        $j = count($data['listtingkatan']);
                        $i = 0;
                    @endphp
                    <p class="mb-2 font-semibold text-bali-700"><label class="" for="tingkatan">Tingkatan
                            Bahasa</label></p>
                    <select class="js-example-basic-multiple w-full mb-4 py-4" name="caritingkatan[]" multiple="multiple">
                        @for ($i = 0; $i < $j; $i++)
                            <option value="{{ $data['listtingkatan'][$i]['tingkatan'] }}">
                                {{ $data['listtingkatan2'][$i]['tingkatan2'] }}</option>
                        @endfor
                    </select>
                </div>
                <div class="">
                    <p class="mb-2"><label class="font-semibold text-bali-700" for="bentuk">Bentuk Kata</label></p>
                    <select class="w-full pl-3 pb-2 rounded-md border-2 border-bali-400" name="caribentuk" id="bentuk">
                        <option value="" disabled selected>Pilih Bentuk Kata</option>
                        @foreach ($data['listbentuk'] as $item)
                            <option value="{{ $item['bentuk'] }}">{{ ucwords(str_replace('_', ' ', $item['bentuk'])) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="">
                    <p class="mb-2"><label class="font-semibold text-bali-700" for="kategori">Kategori
                            Kata</label></p>
                    <select class="w-full pl-3 pb-2 rounded-md border-2 border-bali-400" name="carikategori" id="kategori">
                        <option value="" disabled selected>Pilih Kategori Kata</option>
                        @foreach ($data['listkategori'] as $item)
                            <option value="{{ $item['kategori'] }}">
                                {{ ucwords(str_replace('_', ' ', $item['kategori'])) }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="">
                    <p class="mb-2"><label class="font-semibold text-bali-700" for="awalan">Awalan</label></p>
                    <select class="w-full pl-3 pb-2 rounded-md border-2 border-bali-400" name="cariawalan" id="awalan">
                        <option value="" disabled selected>Pilih Awalan</option>
                        @foreach ($data['listawalan'] as $item)
                            <option value="{{ $item['awalan'] }}">{{ ucwords(str_replace('_', ' ', $item['awalan'])) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="">
                    <p class="mb-2"><label class="font-semibold text-bali-700" for="sisipan">Sisipan</label></p>
                    <select class="w-full pl-3 pb-2 rounded-md border-2 border-bali-400" name="carisisipan" id="sisipan">
                        <option value="" disabled selected>Pilih Sisipan</option>
                        @foreach ($data['listsisipan'] as $item)
                            <option value="{{ $item['sisipan'] }}">
                                {{ ucwords(str_replace('_', ' ', $item['sisipan'])) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="">
                    <p class="mb-2"><label class="font-semibold text-bali-700" for="akhiran">Akhiran</label></p>
                    <select class="w-full pl-3 pb-2 rounded-md border-2 border-bali-400" name="cariakhiran" id="akhiran">
                        <option value="" disabled selected>Pilih Akhiran</option>
                        @foreach ($data['listakhiran'] as $item)
                            <option value="{{ $item['akhiran'] }}">
                                {{ ucwords(str_replace('_', ' ', $item['akhiran'])) }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-7 flex gap-4">
                <button class="bg-bali-200 py-2 px-6 hover:bg-bali-300 text-bali-700 rounded-md" type="submit" name="cari"
                    value="cari">Cari</button>
                <button class="bg-bali-600 py-2 px-6 hover:bg-bali-500 text-bali-100 rounded-md" type="submit" name="reset"
                    value="reset">Reset</button>
            </div>
        </form>
        @if (isset($data['cari']))
            @if ($data['kondisi'] == 0)
                <p class="font-semibold text-lg mt-6"> Masukkan kriteria pencarian terlebih dahulu </p>
            @elseif ($data['kondisi'] == 1)
                @if ($data['jumlahdata'] == 0)
                    <p class="font-semibold text-lg text-red-600 mt-6">Data tidak ditemukan</p>
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
                                    array_multisort(array_column($data['pencarian'], 'namakata'), SORT_ASC, $data['pencarian']);
                                @endphp
                                @foreach ($data['pencarian'] as $item)
                                    <div
                                        class="grid grid-cols-2 gap-7 px-4 py-2 {{ $i % 2 == 0 ? 'bg-bali-50' : 'bg-bali-100' }}">
                                        <div>
                                            <p><a class="hover:font-semibold"
                                                    href="/detail/{{ $item['namakata'] }}">{{ ucfirst(pathinfo($item['namakata'], PATHINFO_FILENAME)) }}
                                                </a></p>
                                        </div>
                                        <div>
                                            <p> {{ $item['tingkatankata'] }} </p>
                                        </div>
                                        @php
                                            $i++;
                                        @endphp
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-span-2 mt-10 lg:mt-0 lg:col-span-1 lg:ml-4 px-4 py-4 rounded-md bg-gray-300 w-full h-max">
                            <p class="pl-4 font-semibold italic mb-2">Query :</p>
                            <p class="pl-4 font-semibold">{{ $data['query'] }}</p>
                        </div>
                    </div>
                @endif
            @endif
        @endif

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
