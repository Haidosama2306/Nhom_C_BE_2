@extends('layout.client.master')
@section('title','- Tìm kiếm')
@section('content')
<div class="border-bottom"></div>
<h3>Kết quả tìm kiếm</h3>
<div class="border-bottom"></div>
<div class="row">
    <div class="col-8">
        @foreach ( $result as $post )
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

    </div>
    <div class="col-4">
        @include('client.latestnews')
    </div>
    <div class="row mt-5">
        <div class="col-md-12 text-center">
            <nav aria-label="Page navigation" class="text-center">
                <ul class="pagination" >
                    {{$result->render()}}
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection
