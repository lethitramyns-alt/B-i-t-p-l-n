@extends('layouts.admin')
@section('title', 'Sửa loại hình')
@section('page_title', 'Sửa loại hình: ' . $type->name)

@section('content')
<div class="card">
    <form action="{{ route('admin.types.update', $type->id) }}" method="POST">
        @csrf @method('PUT')
        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1.5rem;">
            <div>
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Tên loại hình</label>
                <input type="text" name="name" value="{{ old('name', $type->name) }}" class="btn" style="width:100%; background:#f1f5f9; border:1px solid var(--border); text-align:left;" required>
            </div>
            <div>
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Icon</label>
                <input type="text" name="icon" value="{{ old('icon', $type->icon) }}" maxlength="50" class="btn" style="width:100%; background:#f1f5f9; border:1px solid var(--border); text-align:left;">
            </div>
            <div style="grid-column: span 2;">
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Mô tả</label>
                <textarea name="description" rows="5" class="btn" style="width:100%; background:#f1f5f9; border:1px solid var(--border); text-align:left;">{{ old('description', $type->description) }}</textarea>
            </div>
        </div>
        <div style="margin-top:2rem;">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.types.index') }}" class="btn" style="background:#e2e8f0;">Hủy</a>
        </div>
    </form>
</div>
@endsection
