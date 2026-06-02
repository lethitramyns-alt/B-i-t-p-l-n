@extends('layouts.admin')
@section('title', 'Chi tiết điểm đến')
@section('page_title', $destination->name)

@section('content')
<div style="display:grid; grid-template-columns: 1.2fr .8fr; gap:1.5rem;">
    <div class="card">
        @if($destination->image)
            <img src="{{ asset('storage/' . $destination->image) }}" alt="{{ $destination->name }}" style="width:100%; height:320px; object-fit:cover; border-radius:10px; margin-bottom:1.25rem;">
        @endif

        <h2 style="font-size:1.4rem; margin-bottom:.75rem;">{{ $destination->name }}</h2>
        <p style="line-height:1.75; color:#475569; white-space:pre-line;">{{ $destination->description }}</p>

        @if($destination->tips)
            <h3 style="margin-top:1.5rem; margin-bottom:.75rem;">Gợi ý tham quan</h3>
            <p style="line-height:1.75; color:#475569; white-space:pre-line;">{{ $destination->tips }}</p>
        @endif
    </div>

    <div>
        <div class="card">
            <h3 style="margin-bottom:1rem;">Thông tin</h3>
            <div style="display:grid; gap:.8rem;">
                <div><strong>Khu vực:</strong> {{ $destination->region->name }}</div>
                <div><strong>Loại hình:</strong> {{ $destination->destinationType->icon }} {{ $destination->destinationType->name }}</div>
                <div><strong>Địa chỉ:</strong> {{ $destination->address ?: 'Chưa cập nhật' }}</div>
                <div><strong>Lượt xem:</strong> {{ number_format($destination->popularity) }}</div>
                <div><strong>Nổi bật:</strong> {{ $destination->is_featured ? 'Có' : 'Không' }}</div>
                @if($destination->latitude && $destination->longitude)
                    <div><strong>Tọa độ:</strong> {{ $destination->latitude }}, {{ $destination->longitude }}</div>
                @endif
            </div>
        </div>

        @if($destination->gallery && count($destination->gallery) > 0)
            <div class="card">
                <h3 style="margin-bottom:1rem;">Thư viện ảnh</h3>
                <div style="display:grid; grid-template-columns: repeat(2, 1fr); gap:.75rem;">
                    @foreach($destination->gallery as $img)
                        <img src="{{ asset('storage/' . $img) }}" alt="{{ $destination->name }}" style="width:100%; height:120px; object-fit:cover; border-radius:8px;">
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

<div style="margin-top:1rem; display:flex; gap:.75rem;">
    <a href="{{ route('admin.destinations.edit', $destination->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Sửa</a>
    <a href="{{ route('admin.destinations.index') }}" class="btn" style="background:#e2e8f0;">Quay lại</a>
    <a href="{{ route('destinations.show', $destination->slug) }}" class="btn" style="background:#f1f5f9;" target="_blank"><i class="fas fa-external-link-alt"></i> Xem ngoài website</a>
</div>
@endsection
