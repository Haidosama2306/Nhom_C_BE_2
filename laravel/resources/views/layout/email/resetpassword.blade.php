<div style="width: 100%; margin: 0 auto; background: rgb(172, 170, 154);">
    <div style="text-align: center;">
        <h2>Đây là email cài đặt lại mật khẩu</h2>
        <p>vui lòng theo đường dẫn đính kèm để cài đặt lại mật khẩu của bạn</p>
        <p>
            <a href="{{ route('user.getPassword',['user' => $user->id, 'token' => $user->token])}}"
                style="display: inline-block; background: green; color: #fff; padding: 7px 25px;">Click here to reset
                your password</a>
        </p>
        <p>Chú ý: liên kết có hiệu lực trong vòng 72 giờ</p>
        <p>Nếu không phải bạn gửi yêu cầu, vui lòng bỏ qua email này !</p>
    </div>
</div>
