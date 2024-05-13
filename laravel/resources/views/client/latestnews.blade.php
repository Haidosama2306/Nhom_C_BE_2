<div class="container">
    <div class="border-bottom"></div>
    <a href="">
        <h3>Tin mới nhất</h3>
    </a>
    <div class="border-bottom"></div>
    @if (isset($latest_post) && is_object($latest_post))
    @foreach ($latest_post as $post )
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
    <div class="border-bottom"></div>
    @endforeach
    @endif
</div>
