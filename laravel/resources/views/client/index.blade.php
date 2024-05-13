@extends('layout.client.master')
@section('title','- Trang Chủ')
@section('content')

<div class="container">
    <section>
       @include('client.countrysnews');
    </section>

    <section>
        <div class="row">
            <div class="col-5">
                <div class="news_3">
                    <h4><a class="title" href="#">News_2</a></h4>
                    <div class="img"></div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni obcaecati, neque nisi at beatae
                        quidem esse dolores veritatis tempore repellat.</p>
                </div>
                <div class="news_3">
                    <h4><a class="title" href="#">News_2</a></h4>
                    <div class="img"></div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni obcaecati, neque nisi at beatae
                        quidem esse dolores veritatis tempore repellat.</p>
                </div>
                <div class="news_3">
                    <h4><a class="title" href="#">News_2</a></h4>
                    <div class="img"></div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni obcaecati, neque nisi at beatae
                        quidem esse dolores veritatis tempore repellat.</p>
                </div>
            </div>
            <div class="col-7">
                <div class="row">
                    <div class="col-3">
                        <h5><a class="title " style="border-bottom: 2px solid red;" href="#">Catalogues_children</a></h5>
                    </div>
                    <div class="col-3">
                        <h5><a class="title" href="#">Catalogues_children</a></h5>
                    </div>
                    <div class="col-3">
                        <h5><a class="title" href="#">Catalogues_children</a></h5>
                    </div>
                    <div class="col-3">
                        <h5><a class="title" href="#">Catalogues_children</a></h5>
                    </div>
                    <div class="border-bottom"></div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="news_4">
                            <h4><a class="title" href="#">News_2</a></h4>
                            <div class="img"></div>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio iste qui ex quo minus
                                fugiat odit, voluptate nemo soluta veritatis.</p>
                        </div>
                    </div>

                    <div class="col-4">

                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
