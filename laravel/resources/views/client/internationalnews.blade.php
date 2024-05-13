<div class="container">
    <div class="border-bottom"></div>
    <a class="#" href="#">
        <h3>Tin quốc tế</h3>
    </a>
    <div class="border-bottom"></div>

    @if (isset($internationalnews) && is_object($internationalnews))
    @foreach ( $internationalnews as $post )
    <div class="international-news">
        <a class="title" href="#">
            @if(strlen($post->name) > 50 )
            <h5>{{ substr($post->name,0,50) }}...</h5>
            @else
            <h5>{{ $post->name }}</h5>
            @endif
        </a>
        <div class="row">
            <div class="col-6">
                <img src="{{ $post->image }}" alt="img">
            </div>
            <div class="col-6">
                <p>{{ substr($post->description,0,150)  }}</p>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>
