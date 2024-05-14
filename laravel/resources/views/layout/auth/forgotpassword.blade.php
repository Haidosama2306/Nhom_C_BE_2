<div class="modal fade forgotpasswordrModal" id="forgotpasswordrModal" tabindex="-1" role="dialog"
    aria-labelledby="forgotpasswordrModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body ">
                <h2 class="text-center">Lấy lại mật khẩu</h2>
                <form id="registerForm" method="post" action="{{ route('user.forgotPassword') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="email" placeholder="Email đã đăng ký tài khoản" class="form-control" name="email" required>
                    </div>
                    <div class="d-grid mx-auto">
                        <button type="submit" class="btn btn-primary btn-block">
                            Gửi xác nhận qua email
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a class="loginModal" href="#" data-toggle="modal" data-target="#loginModal" data-dismiss="modal"
                    aria-label="Close">
                    Đăng nhập
                </a>
            </div>
        </div>
    </div>
</div>
