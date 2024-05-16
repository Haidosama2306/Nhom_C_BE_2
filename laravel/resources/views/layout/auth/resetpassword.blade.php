@extends('layout.client.master')
@section('title','- Cài lại mật khẩu')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-4 mx-auto" style="border: 1px solid black; margin: 40px 0; padding: 40px">
            <legend class="text-center" style="padding: 20px 0;">Cài lại mật khẩu</legend>
            <form method="post" action="">
                @csrf
                <div class="form-group mb-3">
                    <input type="password" placeholder="Mật khẩu" class="form-control" name="password" required>
                </div>
                <div class="form-group mb-3">
                    <input type="password" placeholder="Nhập lại mật khẩu" class="form-control" name="confirmPassword"
                        required>
                </div>
                <div class="d-grid mx-auto">
                    <button type="submit" class="btn btn-primary btn-block">
                        xác nhận cài lại mật khẩu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
