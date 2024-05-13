<div class="container">
    @if (isset($latest_post) && is_object($latest_post))
    @foreach ($latest_post as $post )
    <div class="lastest-new">
        <a class="title" href="#">
            @if(strlen($post->name) > 60 )
            <h4>{{ substr($post->name,0,60) }}...</h4>
            @else
            <h4>{{ $post->name }}</h4>
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
<div class="border-bottom"></div>
