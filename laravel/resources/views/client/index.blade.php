@extends('layout.client.master')
@section('title','- Trang Chủ')
@section('content')

<div class="row">
    <div class="col-8">
        @include('client.countrysnews');

        @include('client.internationalnews');

    </div>

    <div class="col-4">
        @include('client.latestnews');
    </div>
</div>
@endsection
