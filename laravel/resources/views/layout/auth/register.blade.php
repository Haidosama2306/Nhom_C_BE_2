<div class="modal fade registerModal" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body ">
                <h2 class="text-center">Đăng ký</h2>
                <form id="registerForm" method="post" action="{{ route('user.postUser') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <input type="text" placeholder="Tên người dùng" class="form-control" name="name" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="email" placeholder="Email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" placeholder="Mật khẩu" class="form-control" name="password" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" placeholder="Nhập lại mật khẩu" class="form-control"
                            name="confirmPassword" required>
                    </div>
                    <div class="d-grid mx-auto">
                        <button type="submit" class="btn btn-primary btn-block">Đăng
                            ký</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a class="loginModal" href="#" data-toggle="modal" data-target="#loginModal" data-dismiss="modal"
                    aria-label="Close">
                    Đã có tài khoản ?
                </a>
            </div>
        </div>
    </div>
</div>
