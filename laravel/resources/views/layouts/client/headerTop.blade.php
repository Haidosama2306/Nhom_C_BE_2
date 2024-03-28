<div class="container">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Báo Mới</a>

            <div class="navbar-header headerTop">
                <div class="row ">
                    <div class="col-8">
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
                    <div class="col-4 ">
                        <form class="search-form">
                            <input type="text" class="input-form" placeholder="Nhập từ khóa ..." name="keyword">
                            <button class="btn-search" type="submit">Tìm kiếm</button>

                        </form>
                        <button type="button" class="btn-login" data-toggle="modal" data-target="#fullHeightModalRight">
                            Login
                        </button>
                        <div class="modal fade right" id="fullHeightModalRight" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel" aria-hidden="true">

                            <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
                            <div class="modal-dialog modal-full-height modal-right" role="document">


                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h2 class="text-center"> Login Form</h2>
                                        <div class="form-group mb-3">
                                            <input type="text" placeholder="Email" id="email" class="form-control"
                                                name="email" required autofocus>
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="password" placeholder="Password" id="password"
                                                class="form-control" name="password" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="remember"> Remember Me
                                                </label>
                                            </div>
                                        </div>
                                        <div class="d-grid mx-auto">
                                            <button type="submit" class="btn btn-dark btn-block">Signin</button>
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
