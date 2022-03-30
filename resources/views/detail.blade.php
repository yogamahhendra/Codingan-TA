<?php use App\Http\Controllers\DetailController; ?>
@extends('layouts.main')
@section('head')
@endsection
@section('content')
    <div class="mx-auto w-11/12 lg:w-10/12 laptopl:w-9/12">
        <div class="mt-5 md:mt-10" data-aos="fade" data-aos-delay="200" data-aos-duration="700">
            <div class="grid grid-cols-1 md:grid-cols-6 lg:grid-cols-12 gap-8">
                {{-- Alus Singgih (Mainclass) --}}
                @if ($detail[0]['ext'] == 'asi')
                    <div class="md:col-span-2 lg:col-span-3">
                        <p class="text-sm font-bold text-bali-500 mt-4">Bahasa Bali Alus Singgih</p>
                        <p class="text-2xl font-bold my-2 hover:underline"><a
                                href="/detail/{{ $detail[0]['katautama'] }}">{{ ucfirst(str_replace('.asi', '', $detail[0]['katautama'])) }}</a>
                        </p>
                        <p class="text-3xl font-extrabold mt-4" style="font-family: Vimala">{{ $detail[0]['aksara'] }}</p>
                    </div>
                    <div class="md:col-span-4 lg:col-span-9">
                        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-x-4 laptopl:gap-x-8 md:gap-y-6">
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Bahasa Bali Alus Sor</p>
                                @php $kata = "sor"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                            {{ ucfirst(str_replace('.asor', '', $dtl)) }}</a></p>
                                @endforeach
                            </div>
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Bahsa Bali Alus Mider</p>
                                @php $kata = "mider"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                            {{ ucfirst(str_replace('.ami', '', $dtl)) }}</a></p>
                                @endforeach
                            </div>
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Bahasa Bali Andap</p>
                                @php $kata = "andap"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                            {{ ucfirst(str_replace('.andap', '', $dtl)) }}</a></p>
                                @endforeach
                            </div>
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Bahasa Bali Kasar</p>
                                @php $kata = "kasar"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                            {{ ucfirst(str_replace('.kasar', '', $dtl)) }}</a></p>
                                @endforeach
                            </div>
                            {{-- B. Indo --}}
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Bahasa Indonesia</p>
                                @php $kata = "indonesia"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <p class="text-xl font-bold my-2"><a>
                                            {{ ucfirst(str_replace('.ina', '', $dtl)) }}</a></p>
                                @endforeach
                            </div>
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Variasi</p>
                                @php $kata = "buleleng"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <?php
                                if ($dtl != '-'){
                            ?>
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}> Buleleng :
                                            {{ ucfirst(str_replace('.bll', '', $dtl)) }}</a></p>
                                    <?php
                                } else { ?>
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                            {{ ucfirst(str_replace('.bll', '', $dtl)) }}</a></p>
                                    <?php } ?>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    {{-- Alus Mider (Mainclass) --}}
                @elseif ($detail[0]['ext'] == 'ami')
                    <div class="md:col-span-2 lg:col-span-3">
                        <p class="text-sm font-bold text-bali-500 mt-4">Bahasa Bali Alus Mider</p>
                        <p class="text-2xl font-bold my-2 hover:underline"><a
                                href="/detail/{{ $detail[0]['katautama'] }}">{{ ucfirst(str_replace('.ami', '', $detail[0]['katautama'])) }}</a>
                        </p>
                        <p class="text-3xl font-extrabold mt-4" style="font-family: Vimala">{{ $detail[0]['aksara'] }}
                        </p>
                    </div>
                    <div class="md:col-span-4 lg:col-span-9">
                        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-x-4 laptopl:gap-x-8 md:gap-y-6">
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Bahasa Bali Alus Singgih</p>
                                @php $kata = "singgih"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                            {{ ucfirst(str_replace('.asi', '', $dtl)) }}</a></p>
                                @endforeach
                            </div>
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Bahsa Bali Alus Sor</p>
                                @php $kata = "sor"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                            {{ ucfirst(str_replace('.asor', '', $dtl)) }}</a></p>
                                @endforeach
                            </div>
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Bahasa Bali Andap</p>
                                @php $kata = "andap"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                            {{ ucfirst(str_replace('.andap', '', $dtl)) }}</a></p>
                                @endforeach
                            </div>
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Bahasa Bali Kasar</p>
                                @php $kata = "kasar"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                            {{ ucfirst(str_replace('.kasar', '', $dtl)) }}</a></p>
                                @endforeach
                            </div>
                            {{-- B. Indo --}}
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Bahasa Indonesia</p>
                                @php $kata = "indonesia"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <p class="text-xl font-bold my-2"><a>
                                            {{ ucfirst(str_replace('.ina', '', $dtl)) }}</a></p>
                                @endforeach
                            </div>
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Variasi</p>
                                @php $kata = "buleleng"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <?php
                            if ($dtl != '-'){
                        ?>
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}> Buleleng :
                                            {{ ucfirst(str_replace('.bll', '', $dtl)) }}</a></p>
                                    <?php
                            } else { ?>
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                            {{ ucfirst(str_replace('.bll', '', $dtl)) }}</a></p>
                                    <?php } ?>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    {{-- Alus Sor (Mainclass) --}}
                @elseif ($detail[0]['ext'] == 'asor')
                    <div class="md:col-span-2 lg:col-span-3">
                        <p class="text-sm font-bold text-bali-500 mt-4">Bahasa Bali Alus Sor</p>
                        <p class="text-2xl font-bold my-2 hover:underline"><a
                                href="/detail/{{ $detail[0]['katautama'] }}">{{ ucfirst(str_replace('.asor', '', $detail[0]['katautama'])) }}</a>
                        </p>
                        <p class="text-3xl font-extrabold mt-4" style="font-family: Vimala">{{ $detail[0]['aksara'] }}
                        </p>
                    </div>
                    <div class="md:col-span-4 lg:col-span-9">
                        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-x-4 laptopl:gap-x-8 md:gap-y-6">
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Bahasa Bali Alus Singgih</p>
                                @php $kata = "singgih"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                            {{ ucfirst(str_replace('.asi', '', $dtl)) }}</a></p>
                                @endforeach
                            </div>
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Bahsa Bali Alus Mider</p>
                                @php $kata = "mider"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                            {{ ucfirst(str_replace('.ami', '', $dtl)) }}</a></p>
                                @endforeach
                            </div>
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Bahasa Bali Andap</p>
                                @php $kata = "andap"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                            {{ ucfirst(str_replace('.andap', '', $dtl)) }}</a></p>
                                @endforeach
                            </div>
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Bahasa Bali Kasar</p>
                                @php $kata = "kasar"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                            {{ ucfirst(str_replace('.kasar', '', $dtl)) }}</a></p>
                                @endforeach
                            </div>
                            {{-- B. Indo --}}
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Bahasa Indonesia</p>
                                @php $kata = "indonesia"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <p class="text-xl font-bold my-2"><a>
                                            {{ ucfirst(str_replace('.ina', '', $dtl)) }}</a></p>
                                @endforeach
                            </div>
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Variasi</p>
                                @php $kata = "buleleng"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <?php
                            if ($dtl != '-'){
                        ?>
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}> Buleleng :
                                            {{ ucfirst(str_replace('.bll', '', $dtl)) }}</a></p>
                                    <?php
                            } else { ?>
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                            {{ ucfirst(str_replace('.bll', '', $dtl)) }}</a></p>
                                    <?php } ?>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    {{-- Alus Sor (Endclass) --}}
                    {{-- Andap (Mainclass) --}}
                @elseif ($detail[0]['ext'] == 'andap')
                    <div class="md:col-span-2 lg:col-span-3">
                        <p class="text-sm font-bold text-bali-500 mt-4">Bahasa Bali Andap</p>
                        <p class="text-2xl font-bold my-2 hover:underline"><a
                                href="/detail/{{ $detail[0]['katautama'] }}">{{ ucfirst(str_replace('.andap', '', $detail[0]['katautama'])) }}</a>
                        </p>
                        <p class="text-3xl font-extrabold mt-4" style="font-family: Vimala">{{ $detail[0]['aksara'] }}
                        </p>
                    </div>
                    <div class="md:col-span-4 lg:col-span-9">
                        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-x-4 laptopl:gap-x-8 md:gap-y-6">
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Bahasa Bali Alus Singgih</p>
                                @php $kata = "singgih"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                            {{ ucfirst(str_replace('.asi', '', $dtl)) }}</a></p>
                                @endforeach
                            </div>
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Bahsa Bali Alus Sor</p>
                                @php $kata = "sor"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                            {{ ucfirst(str_replace('.asor', '', $dtl)) }}</a></p>
                                @endforeach
                            </div>
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Bahasa Bali Alus Mider</p>
                                @php $kata = "mider"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                            {{ ucfirst(str_replace('.ami', '', $dtl)) }}</a></p>
                                @endforeach
                            </div>
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Bahasa Bali Kasar</p>
                                @php $kata = "kasar"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                            {{ ucfirst(str_replace('.kasar', '', $dtl)) }}</a></p>
                                @endforeach
                            </div>
                            {{-- B. Indo --}}
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Bahasa Indonesia</p>
                                @php $kata = "indonesia"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <p class="text-xl font-bold my-2"><a>
                                            {{ ucfirst(str_replace('.ina', '', $dtl)) }}</a></p>
                                @endforeach
                            </div>
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Variasi</p>
                                @php $kata = "buleleng"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <?php
                            if ($dtl != '-'){
                        ?>
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}> Buleleng :
                                            {{ ucfirst(str_replace('.bll', '', $dtl)) }}</a></p>
                                    <?php
                            } else { ?>
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                            {{ ucfirst(str_replace('.bll', '', $dtl)) }}</a></p>
                                    <?php } ?>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    {{-- Andap (Endclass) --}}
                    {{-- Kasar (Mainclass) --}}
                @elseif ($detail[0]['ext'] == 'kasar')
                    <div class="md:col-span-2 lg:col-span-3">
                        <p class="text-sm font-bold text-bali-500 mt-4">Bahasa Bali Kasar</p>
                        <p class="text-2xl font-bold my-2 hover:underline"><a
                                href="/detail/{{ $detail[0]['katautama'] }}">{{ ucfirst(str_replace('.kasar', '', $detail[0]['katautama'])) }}</a>
                        </p>
                        <p class="text-3xl font-extrabold mt-4" style="font-family: Vimala">{{ $detail[0]['aksara'] }}
                        </p>
                    </div>
                    <div class="md:col-span-4 lg:col-span-9">
                        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-x-4 laptopl:gap-x-8 md:gap-y-6">
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Bahasa Bali Alus Singgih</p>
                                @php $kata = "singgih"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                            {{ ucfirst(str_replace('.asi', '', $dtl)) }}</a></p>
                                @endforeach
                            </div>
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Bahsa Bali Alus Sor</p>
                                @php $kata = "sor"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                            {{ ucfirst(str_replace('.asor', '', $dtl)) }}</a></p>
                                @endforeach
                            </div>
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Bahasa Bali Alus Mider</p>
                                @php $kata = "mider"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                            {{ ucfirst(str_replace('.ami', '', $dtl)) }}</a></p>
                                @endforeach
                            </div>
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Bahasa Bali Andap</p>
                                @php $kata = "andap"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                            {{ ucfirst(str_replace('.andap', '', $dtl)) }}</a></p>
                                @endforeach
                            </div>
                            {{-- B. Indo --}}
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Bahasa Indonesia</p>
                                @php $kata = "indonesia"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <p class="text-xl font-bold my-2"><a>
                                            {{ ucfirst(str_replace('.ina', '', $dtl)) }}</a></p>
                                @endforeach
                            </div>
                            <div class="rounded-md bg-bali-100 px-5 py-4">
                                <p class="text-sm font-bold text-bali-500">Variasi</p>
                                @php $kata = "buleleng"; @endphp
                                @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                    <?php
                            if ($dtl != '-'){
                        ?>
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}> Buleleng :
                                            {{ ucfirst(str_replace('.bll', '', $dtl)) }}</a></p>
                                    <?php
                            } else { ?>
                                    <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                            {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                            {{ ucfirst(str_replace('.bll', '', $dtl)) }}</a></p>
                                    <?php } ?>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    {{-- Kasar (Endclass) --}}
                    {{-- Buleleng (Mainclass) --}}
                @elseif ($detail[0]['ext'] == 'buleleng')
                <div class="md:col-span-2 lg:col-span-3">
                    <p class="text-sm font-bold text-bali-500 mt-4">Bahasa Bali Variasi Buleleng</p>
                    <p class="text-2xl font-bold my-2 hover:underline"><a
                            href="/detail/{{ $detail[0]['katautama'] }}">{{ ucfirst(str_replace('.bll', '', $detail[0]['katautama'])) }}</a>
                    </p>
                    <p class="text-3xl font-extrabold mt-4" style="font-family: Vimala">{{ $detail[0]['aksara'] }}
                    </p>
                </div>
                <div class="md:col-span-4 lg:col-span-9">
                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-x-4 laptopl:gap-x-8 md:gap-y-6">
                        <div class="rounded-md bg-bali-100 px-5 py-4">
                            <p class="text-sm font-bold text-bali-500">Bahasa Bali Alus Singgih</p>
                            @php $kata = "singgih"; @endphp
                            @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                        {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                        {{ ucfirst(str_replace('.asi', '', $dtl)) }}</a></p>
                            @endforeach
                        </div>
                        <div class="rounded-md bg-bali-100 px-5 py-4">
                            <p class="text-sm font-bold text-bali-500">Bahsa Bali Alus Sor</p>
                            @php $kata = "sor"; @endphp
                            @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                        {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                        {{ ucfirst(str_replace('.asor', '', $dtl)) }}</a></p>
                            @endforeach
                        </div>
                        <div class="rounded-md bg-bali-100 px-5 py-4">
                            <p class="text-sm font-bold text-bali-500">Bahasa Bali Alus Mider</p>
                            @php $kata = "mider"; @endphp
                            @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                        {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                        {{ ucfirst(str_replace('.ami', '', $dtl)) }}</a></p>
                            @endforeach
                        </div>
                        <div class="rounded-md bg-bali-100 px-5 py-4">
                            <p class="text-sm font-bold text-bali-500">Bahasa Bali Andap</p>
                            @php $kata = "andap"; @endphp
                            @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                        {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                        {{ ucfirst(str_replace('.andap', '', $dtl)) }}</a></p>
                            @endforeach
                        </div>
                        {{-- B. Indo --}}
                        <div class="rounded-md bg-bali-100 px-5 py-4">
                            <p class="text-sm font-bold text-bali-500">Bahasa Indonesia</p>
                            @php $kata = "indonesia"; @endphp
                            @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                <p class="text-xl font-bold my-2"><a>
                                        {{ ucfirst(str_replace('.ina', '', $dtl)) }}</a></p>
                            @endforeach
                        </div>
                        {{-- B. Kasar --}}
                        <div class="rounded-md bg-bali-100 px-5 py-4">
                            <p class="text-sm font-bold text-bali-500">Bahasa Bali Kasar</p>
                            @php $kata = "kasar"; @endphp
                            @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                <p class="text-xl font-bold my-2"><a>
                                        {{ ucfirst(str_replace('.kasar', '', $dtl)) }}</a></p>
                            @endforeach
                        </div>
                        
                    </div>
                </div>
                {{-- Buleleng (Endclass) --}}

                @endif
            </div>
            {{-- Informasi --}}
            <div>
                <p class="mt-6 md:mt-10 font-semibold mb-5">Informasi</p>
                <div class="grid grid-cols-2 gap-3 md:grid-cols-3 lg:grid-cols-4 md:gap-y-6 md:gap-x-4 laptopl:gap-x-8">
                    <div class="rounded-md bg-gray-200 px-5 py-4">
                        <p class="text-sm font-bold text-gray-600">Bentuk Kata</p>
                        @php $kata = "bentuk"; @endphp
                        @foreach (DetailController::sameData($detail, $kata) as $dtl)
                            <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                    {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                    {{ ucwords(str_replace('_', ' ', $dtl), ' ') }}</a></p>
                        @endforeach
                    </div>
                    {{-- Kata Utamanya kata turunan --}}
                    @if ($detail[0]['bentuk'] == 'kata_turunan')
                        <div class="rounded-md bg-gray-200 px-5 py-4">
                            <p class="text-sm font-bold text-gray-600">Kata Dasarnya</p>
                            @php $kata = "dasar"; @endphp
                            @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                        {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                        {{ ucfirst(str_replace('.' . $detail[0]['ext'], '', $dtl)) }}</a></p>
                            @endforeach
                        </div>
                    @else
                        <div class="rounded-md bg-gray-200 px-5 py-4">
                            <p class="text-sm font-bold text-gray-600">Kata Turunannya</p>
                            @php $kata = "turunan"; @endphp
                            @foreach (DetailController::sameData($detail, $kata) as $dtl)
                                <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                        {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                        {{ ucfirst(str_replace('.' . $detail[0]['ext'], '', $dtl)) }}</a></p>
                            @endforeach
                        </div>
                    @endif
                    <div class="rounded-md bg-gray-200 px-5 py-4">
                        <p class="text-sm font-bold text-gray-600">Kategori Kata</p>
                        @php $kata = "kategori"; @endphp
                        @foreach (DetailController::sameData($detail, $kata) as $dtl)
                            <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                    {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                    {{ ucwords(str_replace('_', ' ', $dtl), ' ') }}</a></p>
                        @endforeach
                    </div>
                    <div class="rounded-md bg-gray-200 px-5 py-4">
                        <p class="text-sm font-bold text-gray-600">Awalan (Pangater)</p>
                        @php $kata = "awalan"; @endphp
                        @foreach (DetailController::sameData($detail, $kata) as $dtl)
                            <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                    {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                    {{ ucwords(str_replace('_', ' ', $dtl), ' ') }}</a></p>
                        @endforeach
                    </div>
                    <div class="rounded-md bg-gray-200 px-5 py-4">
                        <p class="text-sm font-bold text-gray-600">Sisipan (Seselan)</p>
                        @php $kata = "sisipan"; @endphp
                        @foreach (DetailController::sameData($detail, $kata) as $dtl)
                            <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                    {{ $dtl != '-' ? 'href=' . $dtl : '' }}> {{ str_replace('_','',$dtl) }}</a></p>
                        @endforeach
                    </div>
                    <div class="rounded-md bg-gray-200 px-5 py-4">
                        <p class="text-sm font-bold text-gray-600">Akhiran (Pangiring)</p>
                        @php $kata = "akhiran"; @endphp
                        @foreach (DetailController::sameData($detail, $kata) as $dtl)
                            <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                    {{ $dtl != '-' ? 'href=' . $dtl : '' }}> {{ str_replace('_','',$dtl) }}</a></p>
                        @endforeach
                    </div>
                    <div class="rounded-md bg-gray-200 px-5 py-4">
                        <p class="text-sm font-bold text-gray-600">Lawan Kata (Tungkalikan)</p>
                        @php $kata = "lawan"; @endphp
                        @foreach (DetailController::sameData($detail, $kata) as $dtl)
                            <p class="text-xl font-bold my-2 {{ $dtl != '-' ? 'hover:underline' : '' }}"><a
                                    {{ $dtl != '-' ? 'href=' . $dtl : '' }}>
                                    {{ ucfirst(str_replace('.asi', '', $dtl)) }}</a></p>
                        @endforeach
                    </div>

                </div>
                <div class="rounded-md bg-gray-200 px-5 py-4 mt-4 md:mt-8 mb-14">
                    <p class="text-sm font-bold text-gray-600">Contoh Kalimat</p>
                    @php $kata = "kalimat"; @endphp
                    @foreach (DetailController::sameData($detail, $kata) as $dtl)
                        <p class="text-xl font-bold my-2"><a> {{ $dtl }}</a></p>
                    @endforeach
                </div>
            </div>
        </div>
    @endsection
    @section('script')
    @endsection
