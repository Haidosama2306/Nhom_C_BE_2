<div class="container">
    <div class="border-bottom"></div>
        <h3 style="font-weight: bold;">Tin quốc tế</h3>
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
                <p>{{ substr($post->description,0,200)  }}</p>
            </div>
        </div>
    </div>
    @endforeach
    @endif
    <div class="border-bottom"></div>
</div>

