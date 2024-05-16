@extends('layout.client.master')
@section('title','- Tìm kiếm')
@section('content')
<div class="border-bottom"></div>
<h3>Có {{ count($count) }} trùng khớp</h3>
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
        <div class="container">
            <div class="border-bottom"></div>
            <h3 style="font-weight: bold;">Tin mới nhất</h3>
            <div class="border-bottom"></div>
            @if (isset($searchpost) && is_object($searchpost))
            @foreach ($searchpost as $post )
            <div class="lastest-new">
                <a class="title" href="#">
                    @if(strlen($post->name) > 40 )
                    <h4>{{ substr($post->name,0,40) }}...</h4>
                    @else
                    <h4>{{ $post->name }}</h4>
                    @endif
                </a>
                <p>{{ substr($post->description, 0, 150) }}</p>
            </div>
            @endforeach
            @endif
            <div class="border-bottom"></div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12 text-center">
            <nav aria-label="Page navigation" class="text-center">
                <ul class="pagination">
                    @if (isset($result) && count($result) > 0)

                    @endif
                </ul>
            </nav>
        </div>
    </div>
</div>
@endsection
