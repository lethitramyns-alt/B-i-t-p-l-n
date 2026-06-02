@extends('layouts.admin')
@section('title', 'Chỉnh sửa điểm đến')
@section('page_title', 'Chỉnh sửa: ' . $destination->name)

@section('content')
<div class="card">
    <form action="{{ route('admin.destinations.update', $destination->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div>
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Tên điểm đến</label>
                <input type="text" name="name" class="btn" style="width:100%; background:#f1f5f9; border:1px solid var(--border); text-align:left;" value="{{ old('name', $destination->name) }}" required>
            </div>
            <div>
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Địa chỉ</label>
                <input type="text" name="address" class="btn" style="width:100%; background:#f1f5f9; border:1px solid var(--border); text-align:left;" value="{{ old('address', $destination->address) }}">
            </div>
            <div>
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Vĩ độ</label>
                <input type="number" name="latitude" value="{{ old('latitude', $destination->latitude) }}" step="0.0000001" min="-90" max="90" class="btn" style="width:100%; background:#f1f5f9; border:1px solid var(--border); text-align:left;">
            </div>
            <div>
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Kinh độ</label>
                <input type="number" name="longitude" value="{{ old('longitude', $destination->longitude) }}" step="0.0000001" min="-180" max="180" class="btn" style="width:100%; background:#f1f5f9; border:1px solid var(--border); text-align:left;">
            </div>
            <div>
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Khu vực</label>
                <select name="region_id" class="btn" style="width:100%; background:#f1f5f9; border:1px solid var(--border); text-align:left;" required>
                    @foreach($regions as $r) <option value="{{ $r->id }}" {{ old('region_id', $destination->region_id) == $r->id ? 'selected' : '' }}>{{ $r->name }}</option> @endforeach
                </select>
            </div>
            <div>
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Loại hình</label>
                <select name="destination_type_id" class="btn" style="width:100%; background:#f1f5f9; border:1px solid var(--border); text-align:left;" required>
                    @foreach($types as $t) <option value="{{ $t->id }}" {{ old('destination_type_id', $destination->destination_type_id) == $t->id ? 'selected' : '' }}>{{ $t->name }}</option> @endforeach
                </select>
            </div>
            <div style="grid-column: span 2;">
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Mô tả chi tiết</label>
                <textarea name="description" rows="5" class="btn" style="width:100%; background:#f1f5f9; border:1px solid var(--border); text-align:left;" required>{{ old('description', $destination->description) }}</textarea>
            </div>
            <div style="grid-column: span 2;">
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Gợi ý tham quan</label>
                <textarea name="tips" rows="3" class="btn" style="width:100%; background:#f1f5f9; border:1px solid var(--border); text-align:left;">{{ old('tips', $destination->tips) }}</textarea>
            </div>
            <div>
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Ảnh đại diện (Để trống nếu không đổi)</label>
                <input type="file" name="image" accept="image/*" class="btn" style="width:100%; background:#f1f5f9; border:1px solid var(--border); text-align:left;">
                @if($destination->image) <img src="{{ asset('storage/' . $destination->image) }}" style="width: 100px; margin-top: 10px; border-radius: 8px;"> @endif
            </div>
            <div style="grid-column: span 2;">
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Thư viện ảnh</label>
                <input type="file" name="gallery[]" accept="image/*" multiple class="btn" style="width:100%; background:#f1f5f9; border:1px solid var(--border); text-align:left;">

                @if($destination->gallery && count($destination->gallery) > 0)
                    <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap:1rem; margin-top:1rem;">
                        @foreach($destination->gallery as $img)
                            <label style="display:block; border:1px solid var(--border); border-radius:8px; padding:.5rem; background:#f8fafc;">
                                <img src="{{ asset('storage/' . $img) }}" alt="{{ $destination->name }}" style="width:100%; height:90px; object-fit:cover; border-radius:6px; margin-bottom:.5rem;">
                                <span style="display:flex; align-items:center; gap:.4rem; font-size:.8rem; color:#ef4444;">
                                    <input type="checkbox" name="remove_gallery[]" value="{{ $img }}"> Xóa ảnh này
                                </span>
                            </label>
                        @endforeach
                    </div>
                @endif
            </div>
            <div>
                <label style="display:block; margin-bottom:.5rem; font-weight:600;">Trạng thái</label>
                <label><input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $destination->is_featured) ? 'checked' : '' }}> Điểm đến nổi bật</label>
            </div>
        </div>
        <div style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.destinations.index') }}" class="btn" style="background:#e2e8f0;">Hủy</a>
        </div>
    </form>
</div>
@endsection
