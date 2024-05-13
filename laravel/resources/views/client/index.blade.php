@extends('layout.client.master')
@section('title','- Trang Chủ')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-8">
            <section>
                @include('client.latestnews');
            </section>
            <section>
                @include('client.countrysnews');
            </section>
        </div>

        <div class="col-4">
            <section>

            </section>
        </div>
    </div>
</div>
@endsection
