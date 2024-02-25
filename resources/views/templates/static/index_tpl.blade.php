@extends('index')
@section('content')
    <div class="title"><span>{{ $static->title }}</span></div>
    <div class="w-clear">{!! $static->content ?? '' !!}</div>
@endsection
