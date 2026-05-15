@extends('layouts.app')
@section('title', 'Đăng nhập')
@section('content')
<div style="min-height: 80vh; display: flex; align-items: center; justify-content: center; padding: 2rem; background: #f1f5f9;">
    <div class="card" style="width: 100%; max-width: 400px; padding: 2.5rem;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <h1 style="font-family: 'Playfair Display', serif; font-size: 1.75rem; margin-bottom: .5rem;">Chào mừng trở lại</h1>
            <p style="color: var(--gray); font-size: .9rem;">Đăng nhập để quản lý điểm đến của bạn</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required autofocus placeholder="admin@tourism.vn">
                @error('email') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <label class="form-label">Mật khẩu</label>
                    <a href="{{ route('password.request') }}" style="font-size: .8rem; color: var(--primary); text-decoration: none;">Quên mật khẩu?</a>
                </div>
                <input type="password" name="password" class="form-control" required placeholder="admin123456">
                @error('password') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-check">
                    <input type="checkbox" name="remember">
                    <span style="font-size: .875rem;">Ghi nhớ đăng nhập</span>
                </label>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: .8rem;">
                Đăng nhập ngay
            </button>
        </form>

        <div style="text-align: center; margin-top: 1.5rem; font-size: .875rem; color: var(--gray);">
            Chưa có tài khoản? <a href="{{ route('register') }}" style="color: var(--primary); font-weight: 600; text-decoration: none;">Đăng ký ngay</a>
        </div>
    </div>
</div>
@endsection
