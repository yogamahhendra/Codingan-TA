<? use App\Http\Controllers\levenshteinController ; ?>
@extends('layouts.main')
@section('head')
    
@endsection
@section('content')
<div class="bg-gray-50">
    <div class="flex">
        @php
        $data = levenshteinController::lscoba("babi","babi");
        @endphp



    </div>
</div>
@endsection
@section('script')
    
@endsection