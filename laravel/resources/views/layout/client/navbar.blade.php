<div class="container">
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Trang Chủ <span class="sr-only">(current)</span></a>
                </li>
                @if(isset($post_catalogues_parent) && is_object($post_catalogues_parent))
                @foreach ($post_catalogues_parent as $parent)
                <li class="nav-item dropdown dmenu">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        {{ $parent->name }}
                    </a>
                    <div class="dropdown-menu sm-menu">
                        @if (isset($post_catalogues_children) && is_object($post_catalogues_children))
                        @foreach ($post_catalogues_children as $children )
                        <a class="dropdown-item" href="#">{{ $children->name }}</a>
                        @endforeach
                        @endif
                    </div>
                </li>
                @endforeach
                @endif
            </ul>
        </div>
    </nav>
</div>
</div>
