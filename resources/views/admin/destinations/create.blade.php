@extends('layouts.admin')
@section('title', 'Thêm điểm đến')
@section('page_title', 'Thêm điểm đến mới')

@section('content')
<div class="card">
    <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div>
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Tên điểm đến</label>
                <input type="text" name="name" value="{{ old('name') }}" class="btn" style="width:100%; background:#f1f5f9; border:1px solid var(--border); text-align:left;" required>
            </div>
            <div>
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Địa chỉ</label>
                <input type="text" name="address" value="{{ old('address') }}" class="btn" style="width:100%; background:#f1f5f9; border:1px solid var(--border); text-align:left;">
            </div>
            <div>
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Vĩ độ</label>
                <input type="number" name="latitude" value="{{ old('latitude') }}" step="0.0000001" min="-90" max="90" class="btn" style="width:100%; background:#f1f5f9; border:1px solid var(--border); text-align:left;">
            </div>
            <div>
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Kinh độ</label>
                <input type="number" name="longitude" value="{{ old('longitude') }}" step="0.0000001" min="-180" max="180" class="btn" style="width:100%; background:#f1f5f9; border:1px solid var(--border); text-align:left;">
            </div>
            <div>
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Khu vực</label>
                <select name="region_id" class="btn" style="width:100%; background:#f1f5f9; border:1px solid var(--border); text-align:left;" required>
                    @foreach($regions as $r) <option value="{{ $r->id }}" {{ old('region_id') == $r->id ? 'selected' : '' }}>{{ $r->name }}</option> @endforeach
                </select>
            </div>
            <div>
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Loại hình</label>
                <select name="destination_type_id" class="btn" style="width:100%; background:#f1f5f9; border:1px solid var(--border); text-align:left;" required>
                    @foreach($types as $t) <option value="{{ $t->id }}" {{ old('destination_type_id') == $t->id ? 'selected' : '' }}>{{ $t->name }}</option> @endforeach
                </select>
            </div>
            <div style="grid-column: span 2;">
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Mô tả chi tiết</label>
                <textarea name="description" rows="5" class="btn" style="width:100%; background:#f1f5f9; border:1px solid var(--border); text-align:left;" required>{{ old('description') }}</textarea>
            </div>
            <div style="grid-column: span 2;">
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Gợi ý tham quan (Mỗi dòng một ý)</label>
                <textarea name="tips" rows="3" class="btn" style="width:100%; background:#f1f5f9; border:1px solid var(--border); text-align:left;">{{ old('tips') }}</textarea>
            </div>
            <div>
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Ảnh đại diện</label>
                <input type="file" name="image" accept="image/*" class="btn" style="width:100%; background:#f1f5f9; border:1px solid var(--border); text-align:left;">
            </div>
            <div>
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Thư viện ảnh</label>
                <input type="file" name="gallery[]" accept="image/*" multiple class="btn" style="width:100%; background:#f1f5f9; border:1px solid var(--border); text-align:left;">
                <div style="font-size:.8rem; color:#64748b; margin-top:.35rem;">Có thể chọn nhiều ảnh JPEG, PNG, GIF hoặc WEBP.</div>
            </div>
            <div>
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Trạng thái</label>
                <label><input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}> Điểm đến nổi bật</label>
            </div>
        </div>
        <div style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Lưu điểm đến</button>
            <a href="{{ route('admin.destinations.index') }}" class="btn" style="background:#e2e8f0;">Hủy</a>
        </div>
    </form>
</div>
@endsection
