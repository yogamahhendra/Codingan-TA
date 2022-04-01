@extends('layouts.main')
@section('head')
    
@endsection
@section('content')
<div class="bg-gray-50">
    <div class="flex">
        @php
            $count = count($results['progresses']);
        @endphp
        @for($i=$count-1;$i>=0;$i--)
        <div>
            <p>{{ $results['progresses'][$i][2] }} &nbsp;</p>
            <p>{{ $results['progresses'][$i][0] }} &nbsp;</p>
        </div>
        @endfor
    </div>
</div>
@endsection
@section('script')
    
@endsection