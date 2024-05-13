<div class="container">
    <div class="row">
        <div class="col-7">
            <div class="">
                @if (isset($posts) && is_object($posts))
                @foreach ($posts as $post )
                <div class="">
                    <div class="news_2">
                        <a class="title" href="#">
                            <h4>{{ $post->name }}</h4>
                        </a>
                        <div class="img">
                            <!-- <img src="{{ $post->album }}" alt="img"> -->
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>

        </div>
        <div class="border-bottom"></div>
    </div>
