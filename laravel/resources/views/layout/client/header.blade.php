<div class="container">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ route('home') }}">Báo Mới</a>

            <div class="navbar-header headerTop">
                <div class="row ">
                    <div class="col-6">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link disabled" href="" tabindex="-1" aria-disabled="true">
                                    <?php

                            $dayNames = ['Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy', 'Chủ Nhật'];
                            $dayOfWeek = strftime('%w');
                            $dayOfWeekInVietnamese = $dayNames[$dayOfWeek - 1];

                            $date = date('d/m/Y');
                            echo $dayOfWeekInVietnamese .', '. $date; ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="{{ route('latestnews') }}" tabindex="-1" aria-disabled="true">Tin Mới</a>
                            </li>
                            <li class="nav-item dropdown dmenu">
                                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                    Tin Theo Khu Vực
                                </a>
                                <div class="dropdown-menu sm-menu">
                                    <a class="dropdown-item" href="#">Hồ Chí Minh</a>
                                    <a class="dropdown-item" href="#">Đà Nẵng</a>
                                    <a class="dropdown-item" href="#">Hà Nội</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-4 search-form">
                        <form class="navbar-form" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Nhập từ khóa ..." name="keyword">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i
                                            class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-2">
                        @guest
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">
                            Đăng nhập
                        </button>

                        @include('layout.auth.login')
                        @include('layout.auth.register')
                        @include('layout.auth.forgotpassword')

                        @else
                        <a href="{{ route('signout') }}">Đăng xuất</a>
                        @endguest
                    </div>
                </div>
            </div>
    </div>
    </nav>
</div>
</div>
