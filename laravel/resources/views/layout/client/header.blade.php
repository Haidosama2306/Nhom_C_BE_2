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
                                <a class="nav-link " href="#" tabindex="-1" aria-disabled="true">Tin Mới</a>
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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">
                            Đăng nhập
                        </button>

                        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog"
                            aria-labelledby="loginModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h2 class="text-center">Đăng nhập</h2>
                                        <form id="loginForm">
                                            <div class="form-group mb-3">
                                                <input type="text" placeholder="Email" id="email" class="form-control"
                                                    name="email" required autofocus>
                                            </div>
                                            <div class="form-group mb-3">
                                                <input type="password" placeholder="Mật khẩu" id="password"
                                                    class="form-control" name="password" required>
                                            </div>
                                            <div class="d-grid mx-auto">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#registerModal">Chưa có tài khoản ?</a>
                                                    </div>
                                                    <div class="col-6">
                                                        <button type="submit" class="btn btn-primary btn-block">Đăng
                                                            nhập</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <a class="#" href="#">Quên mật khẩu ?</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="registerModal" tabindex="-1" role="dialog"
                            aria-labelledby="registerModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <h2 class="text-center">Đăng ký</h2>
                                        <form id="registerForm">
                                            <div class="form-group mb-3">
                                                <input type="text" placeholder="Tên người dùng" class="form-control"
                                                    name="username" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <input type="email" placeholder="Email" class="form-control"
                                                    name="email" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <input type="password" placeholder="Mật khẩu" class="form-control"
                                                    name="password" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <input type="password" placeholder="Nhập lại mật khẩu"
                                                    class="form-control" name="confirmPassword" required>
                                            </div>
                                            <div class="d-grid mx-auto">
                                                <button type="submit" class="btn btn-primary btn-block">Đăng ký</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </nav>
</div>
</div>
