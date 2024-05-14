<div class="modal fade loginModal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h2 class="text-center">Đăng nhập</h2>
                <form id="loginForm" method="post" action="{{ route('user.authUser') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="text" placeholder="Email" id="email" class="form-control" name="email" required
                            autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" placeholder="Mật khẩu" id="password" class="form-control" name="password"
                            required>
                    </div>
                    <div class="d-grid mx-auto">
                        <div class="row">
                            <div class="col-6">
                                <a class="registerModal" href="#" data-toggle="modal" data-target="#registerModal"
                                    data-dismiss="modal" aria-label="Close">
                                    Chưa có tài khoản ?
                                </a>
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
                <a class="forgotpasswordrModal" href="#" data-toggle="modal" data-target="#forgotpasswordrModal"
                    data-dismiss="modal" aria-label="Close">
                    Quên mật khẩu ?
                </a>
            </div>
        </div>
    </div>
</div>
