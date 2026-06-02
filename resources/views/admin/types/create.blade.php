@extends('layouts.admin')
@section('title', 'Thêm loại hình')
@section('page_title', 'Thêm loại hình du lịch')

@section('content')
<div class="card">
    <form action="{{ route('admin.types.store') }}" method="POST">
        @csrf
        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1.5rem;">
            <div>
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Tên loại hình</label>
                <input type="text" name="name" value="{{ old('name') }}" class="btn" style="width:100%; background:#f1f5f9; border:1px solid var(--border); text-align:left;" required>
            </div>
            <div>
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Icon</label>
                <input type="text" name="icon" value="{{ old('icon') }}" maxlength="50" class="btn" style="width:100%; background:#f1f5f9; border:1px solid var(--border); text-align:left;" placeholder="Ví dụ: 🏝️">
            </div>
            <div style="grid-column: span 2;">
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Mô tả</label>
                <textarea name="description" rows="5" class="btn" style="width:100%; background:#f1f5f9; border:1px solid var(--border); text-align:left;">{{ old('description') }}</textarea>
            </div>
        </div>
        <div style="margin-top:2rem;">
            <button type="submit" class="btn btn-primary">Lưu loại hình</button>
            <a href="{{ route('admin.types.index') }}" class="btn" style="background:#e2e8f0;">Hủy</a>
        </div>
    </form>
</div>
@endsection
