<div class="container">
    <div class="border-bottom"></div>
        <h3 style="font-weight: bold;">Tin mới nhất</h3>
    <div class="border-bottom"></div>
    @if (isset($latestpost) && is_object($latestpost))
    @foreach ($latestpost as $post )
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
