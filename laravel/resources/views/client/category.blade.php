@extends('layout.client.master')
@section('title','- Tin tức')
@section('content')
<div class="border-bottom"></div>
@if (isset($catachildren))
<h3>Tin tức {{ $catachildren }}</h3>
@else
<h3>Tin tức mới nhất</h3>
@endif
<div class="border-bottom"></div>
<div class="row">
    <div class="col-8">
        @if (isset($posts))
        @foreach ( $posts as $post )
        <div class="catagory">
            <a class="title" href="#">
                <h5>{{ $post->name }}</h5>
            </a>
            <div class="row">
                <div class="col-6">
                    <img src="{{ $post->image }}" alt="img">
                </div>
                <div class="col-6">
                    <p>{{ substr($post->description,0,400)  }}</p>
                </div>
            </div>
        </div>
        @endforeach

        @elseif(isset($latestnews))
        @foreach ( $latestnews as $post )
        <div class="catagory">
            <a class="title" href="#">
                <h5>{{ $post->name }}</h5>
            </a>
            <div class="row">
                <div class="col-6">
                    <img src="{{ $post->image }}" alt="img">
                </div>
                <div class="col-6">
                    <p>{{ substr($post->description,0,400)  }}</p>
                </div>
            </div>
        </div>
        @endforeach
        @endif

    </div>
    <div class="col-4">
        @include('client.latestnews')
    </div>
    <div class="row mt-5">
        <div class="col-md-12 text-center">
            <nav aria-label="Page navigation" class="text-center">
                <ul class="pagination">
                    @if (isset($posts))
                    {{$posts->render()}}
                    @elseif (isset($latestnews))
                    {{$latestnews->render()}}
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection
