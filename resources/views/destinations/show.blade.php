@extends('layouts.app')

@section('title', $destination->name)

@push('styles')
<style>
    .dest-hero { position:relative; height:500px; overflow:hidden; }
    .dest-hero img { width:100%; height:100%; object-fit:cover; }
    .dest-hero-ph { width:100%; height:100%; background:linear-gradient(135deg,#667eea,#764ba2); display:flex; align-items:center; justify-content:center; color:white; font-size:6rem; }
    .dest-hero-overlay { position:absolute; inset:0; background:linear-gradient(to top,rgba(0,0,0,.85) 0%,rgba(0,0,0,.3) 60%,transparent 100%); display:flex; align-items:flex-end; }
    .dest-hero-content { padding:2.5rem; color:white; width:100%; }
    .dest-hero-content h1 { font-family:'Playfair Display',serif; font-size:clamp(1.75rem,4vw,3rem); font-weight:700; margin-bottom:.5rem; }
    .dest-breadcrumb { display:flex; align-items:center; gap:.5rem; font-size:.85rem; color:rgba(255,255,255,.7); margin-bottom:1rem; }
    .dest-breadcrumb a { color:rgba(255,255,255,.7); text-decoration:none; } .dest-breadcrumb a:hover { color:white; }
    .dest-meta { display:flex; gap:1.5rem; flex-wrap:wrap; }
    .dest-meta-item { display:flex; align-items:center; gap:.4rem; font-size:.9rem; color:rgba(255,255,255,.85); }

    .dest-main { max-width:1280px; margin:0 auto; padding:0 1.5rem; display:grid; grid-template-columns:2fr 1fr; gap:2rem; margin-top:-2rem; position:relative; z-index:10; }
    @media (max-width:900px) { .dest-main { grid-template-columns:1fr; } }

    .content-card { background:white; border-radius:var(--radius); box-shadow:var(--shadow); padding:2rem; margin-bottom:1.5rem; }
    .content-card h2 { font-size:1.25rem; font-weight:700; color:var(--dark); margin-bottom:1rem; display:flex; align-items:center; gap:.5rem; }
    .content-card p { color:#475569; line-height:1.8; }

    .tips-list { list-style:none; }
    .tips-list li { padding:.6rem 0; border-bottom:1px solid var(--border); color:#475569; display:flex; align-items:flex-start; gap:.6rem; font-size:.9rem; line-height:1.6; }
    .tips-list li:last-child { border-bottom:none; }
    .tips-list li::before { content:'✓'; color:var(--accent); font-weight:700; margin-top:.1rem; }

    .sidebar-card { background:white; border-radius:var(--radius); box-shadow:var(--shadow); overflow:hidden; margin-bottom:1.5rem; }
    .sidebar-card-header { padding:1.25rem; border-bottom:1px solid var(--border); font-weight:700; display:flex; align-items:center; gap:.5rem; }
    .sidebar-card-body { padding:1.25rem; }

    .info-item { display:flex; align-items:flex-start; gap:.75rem; margin-bottom:1rem; }
    .info-item:last-child { margin-bottom:0; }
    .info-icon { width:38px; height:38px; border-radius:var(--radius-sm); background:linear-gradient(135deg,var(--primary),var(--accent)); display:flex; align-items:center; justify-content:center; color:white; font-size:1rem; flex-shrink:0; }
    .info-label { font-size:.75rem; color:var(--gray); font-weight:600; }
    .info-value { font-size:.9rem; color:var(--dark); font-weight:500; }

    .fav-btn-big {
        width:100%; padding:1rem; border-radius:var(--radius-sm); border:2px solid;
        font-size:1rem; font-weight:600; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:.6rem;
        transition:all .25s; margin-bottom:.75rem;
    }
    .fav-btn-big.active { background:#fef2f2; border-color:#fca5a5; color:#dc2626; }
    .fav-btn-big.inactive { background:#f0fdf4; border-color:#86efac; color:#16a34a; }
    .fav-btn-big:hover { transform:scale(1.02); }

    .gallery-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:.5rem; margin-top:1rem; }
    .gallery-img { border-radius:8px; overflow:hidden; aspect-ratio:1; }
    .gallery-img img { width:100%; height:100%; object-fit:cover; cursor:pointer; transition:transform .3s; }
    .gallery-img img:hover { transform:scale(1.05); }

    .map-frame { border-radius:var(--radius-sm); overflow:hidden; }

    .related-card { display:flex; gap:.75rem; margin-bottom:.85rem; text-decoration:none; padding:.5rem; border-radius:var(--radius-sm); transition:background .15s; }
    .related-card:hover { background:#f8fafc; }
    .related-thumb { width:70px; height:60px; border-radius:8px; overflow:hidden; flex-shrink:0; }
    .related-thumb img, .related-thumb-ph { width:100%; height:100%; object-fit:cover; }
    .related-thumb-ph { background:linear-gradient(135deg,#667eea,#764ba2); display:flex; align-items:center; justify-content:center; color:white; font-size:1.5rem; }
    .related-info { flex:1; min-width:0; }
    .related-name { font-size:.875rem; font-weight:600; color:var(--dark); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
    .related-region { font-size:.75rem; color:var(--gray); }
</style>
@endpush

@section('content')
<!-- HERO -->
<div class="dest-hero">
    @if($destination->image)
        <img src="{{ asset('storage/' . $destination->image) }}" alt="{{ $destination->name }}">
    @else
        <div class="dest-hero-ph">{{ $destination->destinationType->icon ?? '🌏' }}</div>
    @endif
    <div class="dest-hero-overlay">
        <div class="dest-hero-content">
            <div class="dest-breadcrumb">
                <a href="{{ route('home') }}">Trang chủ</a>
                <span>›</span>
                <a href="{{ route('destinations.index') }}">Điểm đến</a>
                <span>›</span>
                <span>{{ $destination->name }}</span>
            </div>
            <div style="margin-bottom:.75rem;">
                <span class="badge badge-primary">{{ $destination->destinationType->icon }} {{ $destination->destinationType->name }}</span>
                @if($destination->is_featured)
                <span class="badge badge-orange" style="margin-left:.5rem;">⭐ Nổi bật</span>
                @endif
            </div>
            <h1>{{ $destination->name }}</h1>
            <div class="dest-meta">
                <div class="dest-meta-item"><i class="fas fa-map-marker-alt"></i> {{ $destination->region->name }}</div>
                <div class="dest-meta-item"><i class="fas fa-eye"></i> {{ number_format($destination->popularity) }} lượt xem</div>
                @if($destination->address)
                <div class="dest-meta-item"><i class="fas fa-location-arrow"></i> {{ $destination->address }}</div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="dest-main">
    <!-- LEFT CONTENT -->
    <div>
        <!-- DESCRIPTION -->
        <div class="content-card">
            <h2>📖 Giới thiệu</h2>
            <p>{{ $destination->description }}</p>
        </div>

        <!-- TIPS -->
        @if($destination->tips)
        <div class="content-card">
            <h2>💡 Gợi ý tham quan</h2>
            <ul class="tips-list">
                @foreach(explode("\n", $destination->tips) as $tip)
                @if(trim($tip))
                <li>{{ ltrim(trim($tip), '-•') }}</li>
                @endif
                @endforeach
            </ul>
        </div>
        @endif

        <!-- GALLERY -->
        @if($destination->gallery && count($destination->gallery) > 0)
        <div class="content-card">
            <h2>🖼️ Hình ảnh</h2>
            <div class="gallery-grid">
                @foreach($destination->gallery as $img)
                <div class="gallery-img">
                    <img src="{{ asset('storage/' . $img) }}" alt="{{ $destination->name }}" loading="lazy">
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- MAP -->
        @if($destination->latitude && $destination->longitude)
        <div class="content-card">
            <h2>🗺️ Vị trí trên bản đồ</h2>
            <div class="map-frame">
                <iframe
                    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY&q={{ $destination->latitude }},{{ $destination->longitude }}&zoom=14"
                    width="100%"
                    height="350"
                    style="border:0;border-radius:var(--radius-sm);"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
            </div>
            <p style="font-size:.8rem;color:var(--gray);margin-top:.5rem;"><i class="fas fa-map-pin"></i> {{ $destination->latitude }}, {{ $destination->longitude }}</p>
        </div>
        @endif
    </div>

    <!-- SIDEBAR -->
    <div>
        <!-- FAV BUTTON -->
        @auth
        <div class="sidebar-card">
            <div class="sidebar-card-body">
                <form method="POST" action="{{ route('favorites.toggle', $destination->id) }}" id="favForm">
                    @csrf
                    <button type="submit" class="fav-btn-big {{ $isFavorited ? 'active' : 'inactive' }}">
                        {{ $isFavorited ? '❤️ Đã lưu yêu thích' : '🤍 Lưu vào yêu thích' }}
                    </button>
                </form>
                <a href="{{ route('favorites.index') }}" class="btn btn-outline" style="width:100%;justify-content:center;color:var(--gray);border-color:var(--border);">
                    <i class="fas fa-list"></i> Danh sách yêu thích
                </a>
            </div>
        </div>
        @else
        <div class="sidebar-card">
            <div class="sidebar-card-body" style="text-align:center;">
                <p style="color:var(--gray);font-size:.9rem;margin-bottom:1rem;">Đăng nhập để lưu điểm đến yêu thích!</p>
                <a href="{{ route('login') }}" class="btn btn-primary" style="width:100%;justify-content:center;">
                    <i class="fas fa-sign-in-alt"></i> Đăng nhập
                </a>
            </div>
        </div>
        @endauth

        <!-- INFO -->
        <div class="sidebar-card">
            <div class="sidebar-card-header">ℹ️ Thông tin</div>
            <div class="sidebar-card-body">
                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <div class="info-label">Khu vực</div>
                        <div class="info-value">{{ $destination->region->name }}</div>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">{{ $destination->destinationType->icon ?? '🌏' }}</div>
                    <div>
                        <div class="info-label">Loại hình</div>
                        <div class="info-value">{{ $destination->destinationType->name }}</div>
                    </div>
                </div>
                @if($destination->address)
                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-location-arrow"></i></div>
                    <div>
                        <div class="info-label">Địa chỉ</div>
                        <div class="info-value">{{ $destination->address }}</div>
                    </div>
                </div>
                @endif
                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-eye"></i></div>
                    <div>
                        <div class="info-label">Lượt xem</div>
                        <div class="info-value">{{ number_format($destination->popularity) }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RELATED -->
        @if($related->count() > 0)
        <div class="sidebar-card">
            <div class="sidebar-card-header">🔗 Điểm đến liên quan</div>
            <div class="sidebar-card-body">
                @foreach($related as $rel)
                <a href="{{ route('destinations.show', $rel->slug) }}" class="related-card">
                    <div class="related-thumb">
                        @if($rel->image)
                            <img src="{{ asset('storage/' . $rel->image) }}" alt="{{ $rel->name }}" loading="lazy">
                        @else
                            <div class="related-thumb-ph">{{ $rel->destinationType->icon ?? '🌏' }}</div>
                        @endif
                    </div>
                    <div class="related-info">
                        <div class="related-name">{{ $rel->name }}</div>
                        <div class="related-region"><i class="fas fa-map-marker-alt" style="color:var(--primary);font-size:.7rem;"></i> {{ $rel->region->name }}</div>
                        <div style="font-size:.72rem;color:var(--gray);margin-top:.15rem;"><i class="fas fa-eye"></i> {{ number_format($rel->popularity) }}</div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- SHARE -->
        <div class="sidebar-card">
            <div class="sidebar-card-header">📤 Chia sẻ</div>
            <div class="sidebar-card-body">
                <div style="display:flex;gap:.6rem;">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="btn btn-primary btn-sm" style="flex:1;justify-content:center;background:#1877f2;">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </a>
                    <button onclick="navigator.clipboard.writeText(window.location.href);alert('Đã sao chép link!')" class="btn btn-sm" style="flex:1;background:#f1f5f9;color:var(--dark);border:1px solid var(--border);">
                        <i class="fas fa-link"></i> Sao chép
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="height:3rem;"></div>
@endsection
