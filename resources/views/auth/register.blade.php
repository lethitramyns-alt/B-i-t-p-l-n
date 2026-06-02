@extends('layouts.app')
@section('title', 'Đăng ký tài khoản')
@section('content')
<div style="min-height: 80vh; display: flex; align-items: center; justify-content: center; padding: 2rem; background: #f1f5f9;">
    <div class="card" style="width: 100%; max-width: 450px; padding: 2.5rem;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <h1 style="font-family: 'Playfair Display', serif; font-size: 1.75rem; margin-bottom: .5rem;">Bắt đầu hành trình</h1>
            <p style="color: var(--gray); font-size: .9rem;">Khám phá những điểm đến tuyệt vời nhất Việt Nam</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Họ và tên</label>
                <input type="text" name="name" class="form-control" required autofocus placeholder="Nguyễn Văn A">
                @error('name') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Địa chỉ Email</label>
                <input type="email" name="email" class="form-control" required placeholder="example@email.com">
                @error('email') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Mật khẩu</label>
                <input type="password" name="password" class="form-control" required placeholder="Ít nhất 8 ký tự">
                @error('password') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Xác nhận mật khẩu</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: .8rem;">
                Tạo tài khoản miễn phí
            </button>
        </form>

        <div style="text-align: center; margin-top: 1.5rem; font-size: .875rem; color: var(--gray);">
            Đã có tài khoản? <a href="{{ route('login') }}" style="color: var(--primary); font-weight: 600; text-decoration: none;">Đăng nhập</a>
        </div>
    </div>
</div>
@endsection
