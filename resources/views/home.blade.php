@extends('layouts.app')

@section('title', 'Trang chủ - Khám Phá Việt Nam')

@push('styles')
<style>
    /* HERO */
    .hero {
        min-height: 92vh;
        background: linear-gradient(135deg, #0f172a 0%, #0c4a6e 50%, #064e3b 100%);
        position: relative;
        display: flex;
        align-items: center;
        overflow: hidden;
    }
    .hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .hero-glow {
        position: absolute;
        width: 600px; height: 600px;
        border-radius: 50%;
        filter: blur(120px);
        opacity: .25;
    }
    .hero-glow-1 { background: #0ea5e9; top: -100px; left: -100px; }
    .hero-glow-2 { background: #10b981; bottom: -100px; right: -100px; }
    .hero-content {
        position: relative;
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 1.5rem;
        text-align: center;
    }
    .hero-tag {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .4rem 1rem;
        background: rgba(14,165,233,.15);
        border: 1px solid rgba(14,165,233,.3);
        border-radius: 999px;
        color: #38bdf8;
        font-size: .85rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        letter-spacing: .5px;
    }
    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2.5rem, 6vw, 4.5rem);
        font-weight: 700;
        color: white;
        line-height: 1.15;
        margin-bottom: 1.25rem;
    }
    .hero-title span { color: #38bdf8; }
    .hero-desc {
        font-size: 1.15rem;
        color: rgba(255,255,255,.7);
        max-width: 620px;
        margin: 0 auto 2.5rem;
        line-height: 1.8;
    }
    .hero-search {
        background: white;
        border-radius: 16px;
        padding: .5rem;
        display: flex;
        gap: .5rem;
        max-width: 680px;
        margin: 0 auto 3rem;
        box-shadow: 0 20px 60px rgba(0,0,0,.3);
    }
    .hero-search input {
        flex: 1;
        border: none;
        outline: none;
        padding: .75rem 1rem;
        font-size: 1rem;
        border-radius: 10px;
        font-family: 'Inter', sans-serif;
    }
    .hero-search select {
        border: none;
        outline: none;
        padding: .75rem 1rem;
        font-size: .9rem;
        border-radius: 10px;
        background: #f1f5f9;
        font-family: 'Inter', sans-serif;
        color: #475569;
        cursor: pointer;
    }
    .hero-search button {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border: none;
        padding: .75rem 1.5rem;
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all .2s;
        white-space: nowrap;
    }
    .hero-search button:hover { opacity: .9; transform: scale(1.02); }
    .hero-stats {
        display: flex;
        gap: 3rem;
        justify-content: center;
    }
    .hero-stat { text-align: center; }
    .hero-stat-num {
        font-size: 2rem;
        font-weight: 800;
        color: white;
        display: block;
    }
    .hero-stat-label { color: rgba(255,255,255,.6); font-size: .85rem; }

    /* TYPES */
    .type-grid { display: flex; gap: 1rem; flex-wrap: wrap; justify-content: center; }
    .type-chip {
        display: flex; flex-direction: column; align-items: center; gap: .4rem;
        padding: 1.25rem 1.5rem; background: white; border-radius: var(--radius);
        border: 2px solid transparent; cursor: pointer; text-decoration: none;
        transition: all .25s; box-shadow: var(--shadow);
        min-width: 100px; text-align: center;
    }
    .type-chip:hover { border-color: var(--primary); transform: translateY(-3px); box-shadow: 0 8px 25px rgba(14,165,233,.2); }
    .type-chip-icon { font-size: 2rem; }
    .type-chip-name { font-size: .8rem; font-weight: 600; color: var(--dark); }
    .type-chip-count { font-size: .72rem; color: var(--gray); }

    /* DEST CARD */
    .dest-card { background: white; border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow); transition: all .3s; }
    .dest-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); }
    .dest-card-img { position: relative; overflow: hidden; height: 220px; }
    .dest-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s; }
    .dest-card:hover .dest-card-img img { transform: scale(1.08); }
    .dest-card-badge { position: absolute; top: .75rem; left: .75rem; }
    .dest-card-fav {
        position: absolute; top: .75rem; right: .75rem;
        width: 36px; height: 36px; background: rgba(255,255,255,.9); backdrop-filter: blur(4px);
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        cursor: pointer; border: none; font-size: 1rem; transition: all .2s;
        text-decoration: none;
    }
    .dest-card-fav:hover { background: white; transform: scale(1.1); }
    .dest-card-body { padding: 1.25rem; }
    .dest-card-type { font-size: .75rem; font-weight: 600; color: var(--primary); margin-bottom: .25rem; }
    .dest-card-name { font-size: 1.05rem; font-weight: 700; color: var(--dark); margin-bottom: .4rem; text-decoration: none; display: block; }
    .dest-card-name:hover { color: var(--primary); }
    .dest-card-region { font-size: .82rem; color: var(--gray); display: flex; align-items: center; gap: .3rem; }
    .dest-card-footer { display: flex; align-items: center; justify-content: space-between; margin-top: .85rem; padding-top: .85rem; border-top: 1px solid var(--border); }
    .dest-card-views { font-size: .8rem; color: var(--gray); display: flex; align-items: center; gap: .3rem; }

    /* REGION CARD */
    .region-card { border-radius: var(--radius); overflow: hidden; position: relative; height: 200px; cursor: pointer; box-shadow: var(--shadow); }
    .region-card img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s; }
    .region-card:hover img { transform: scale(1.1); }
    .region-card-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,.75) 0%, transparent 60%);
        display: flex; flex-direction: column; justify-content: flex-end; padding: 1.25rem;
    }
    .region-card-name { color: white; font-size: 1.1rem; font-weight: 700; }
    .region-card-count { color: rgba(255,255,255,.75); font-size: .8rem; }

    /* FEATURED SECTION */
    .featured-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; }
    .featured-main { position: relative; border-radius: var(--radius); overflow: hidden; height: 450px; }
    .featured-main img { width: 100%; height: 100%; object-fit: cover; }
    .featured-main-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,.85) 0%, transparent 50%); display: flex; flex-direction: column; justify-content: flex-end; padding: 2rem; }
    .featured-main-overlay h2 { font-family: 'Playfair Display', serif; color: white; font-size: 2rem; margin-bottom: .5rem; }
    .featured-main-overlay p { color: rgba(255,255,255,.8); font-size: .9rem; max-width: 450px; }
    .featured-side { display: flex; flex-direction: column; gap: 1rem; }
    .featured-side-item { position: relative; border-radius: var(--radius); overflow: hidden; flex: 1; cursor: pointer; }
    .featured-side-item img { width: 100%; height: 100%; object-fit: cover; }
    .featured-side-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,.75), transparent 60%); display: flex; flex-direction: column; justify-content: flex-end; padding: 1rem; }
    .featured-side-overlay span { color: white; font-size: .9rem; font-weight: 600; }

    @media (max-width: 768px) {
        .hero-stats { gap: 1.5rem; }
        .hero-stat-num { font-size: 1.5rem; }
        .hero-search { flex-direction: column; }
        .featured-grid { grid-template-columns: 1fr; }
        .featured-main { height: 280px; }
        .dest-grid { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 480px) {
        .dest-grid { grid-template-columns: 1fr; }
        .type-chip { min-width: 80px; padding: 1rem; }
    }

    .dest-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
    .region-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }
    @media (max-width: 1024px) {
        .dest-grid { grid-template-columns: repeat(2, 1fr); }
        .region-grid { grid-template-columns: repeat(2, 1fr); }
    }

    /* PLACEHOLDER IMAGE */
    .img-placeholder { background: linear-gradient(135deg, #667eea, #764ba2); display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem; width: 100%; height: 100%; }
</style>
@endpush

@section('content')
<!-- HERO -->
<section class="hero">
    <div class="hero-glow hero-glow-1"></div>
    <div class="hero-glow hero-glow-2"></div>
    <div class="hero-content">
        <div class="hero-tag">
            <span>🌟</span> Hệ thống du lịch thông minh
        </div>
        <h1 class="hero-title">
            Khám Phá Vẻ Đẹp<br>
            <span>Việt Nam</span> Tuyệt Vời
        </h1>
        <p class="hero-desc">
            Tìm kiếm và lưu trữ những điểm đến du lịch tuyệt đẹp nhất Việt Nam. Từ bãi biển hoang sơ đến núi non hùng vĩ, chúng tôi có tất cả!
        </p>

        <!-- SEARCH BAR -->
        <form class="hero-search" action="{{ route('destinations.index') }}" method="GET">
            <input type="text" name="search" placeholder="🔍 Tìm kiếm điểm đến..." value="{{ request('search') }}">
            <select name="region">
                <option value="">Tất cả khu vực</option>
                @foreach($regions as $region)
                <option value="{{ $region->id }}">{{ $region->name }}</option>
                @endforeach
            </select>
            <button type="submit">Tìm ngay</button>
        </form>

        <div class="hero-stats">
            <div class="hero-stat">
                <span class="hero-stat-num">{{ $stats['destinations'] }}+</span>
                <span class="hero-stat-label">Điểm đến</span>
            </div>
            <div class="hero-stat">
                <span class="hero-stat-num">{{ $stats['regions'] }}</span>
                <span class="hero-stat-label">Khu vực</span>
            </div>
            <div class="hero-stat">
                <span class="hero-stat-num">{{ $stats['types'] }}</span>
                <span class="hero-stat-label">Loại hình</span>
            </div>
        </div>
    </div>
</section>

<!-- LOẠI HÌNH -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <div class="badge badge-primary" style="margin-bottom:.75rem;">🗂️ Phân loại</div>
            <h2 class="section-title">Khám Phá Theo Loại Hình</h2>
            <p class="section-subtitle">Tìm kiếm điểm đến theo sở thích du lịch của bạn</p>
        </div>
        <div class="type-grid">
            @foreach($types as $type)
            <a href="{{ route('destinations.index') }}?type={{ $type->id }}" class="type-chip">
                <span class="type-chip-icon">{{ $type->icon }}</span>
                <span class="type-chip-name">{{ $type->name }}</span>
                <span class="type-chip-count">{{ $type->destinations_count }} điểm</span>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- NỔI BẬT -->
@if($featured->count() > 0)
<section class="section" style="padding-top:0;">
    <div class="container">
        <div class="section-header">
            <div class="badge badge-orange" style="margin-bottom:.75rem;">⭐ Nổi bật</div>
            <h2 class="section-title">Điểm Đến Nổi Bật</h2>
            <p class="section-subtitle">Những địa điểm được yêu thích và bình chọn nhiều nhất</p>
        </div>
        <div class="featured-grid">
            @if($featured->count() > 0)
            <a href="{{ route('destinations.show', $featured[0]->slug) }}" style="text-decoration:none;" class="featured-main">
                @if($featured[0]->image)
                    <img src="{{ asset('storage/' . $featured[0]->image) }}" alt="{{ $featured[0]->name }}">
                @else
                    <div class="img-placeholder">{{ $featured[0]->destinationType->icon ?? '🏖️' }}</div>
                @endif
                <div class="featured-main-overlay">
                    <div class="badge badge-primary" style="margin-bottom:.5rem;width:fit-content;">{{ $featured[0]->destinationType->name }}</div>
                    <h2>{{ $featured[0]->name }}</h2>
                    <p>{{ Str::limit($featured[0]->description, 100) }}</p>
                    <div style="display:flex;align-items:center;gap:1rem;margin-top:.75rem;">
                        <span style="color:rgba(255,255,255,.7);font-size:.85rem;"><i class="fas fa-map-marker-alt"></i> {{ $featured[0]->region->name }}</span>
                        <span style="color:rgba(255,255,255,.7);font-size:.85rem;"><i class="fas fa-eye"></i> {{ number_format($featured[0]->popularity) }} lượt xem</span>
                    </div>
                </div>
            </a>
            <div class="featured-side">
                @foreach($featured->skip(1)->take(2) as $dest)
                <a href="{{ route('destinations.show', $dest->slug) }}" style="text-decoration:none;flex:1;" class="featured-side-item">
                    @if($dest->image)
                        <img src="{{ asset('storage/' . $dest->image) }}" alt="{{ $dest->name }}">
                    @else
                        <div class="img-placeholder" style="font-size:2rem;">{{ $dest->destinationType->icon ?? '🏔️' }}</div>
                    @endif
                    <div class="featured-side-overlay">
                        <span>{{ $dest->name }}</span>
                        <span style="color:rgba(255,255,255,.65);font-size:.75rem;">{{ $dest->region->name }}</span>
                    </div>
                </a>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>
@endif

<!-- PHỔ BIẾN NHẤT -->
<section class="section" style="background:#f8fafc;padding:4rem 0;">
    <div class="container">
        <div class="section-header">
            <div class="badge badge-success" style="margin-bottom:.75rem;">🔥 Phổ biến</div>
            <h2 class="section-title">Điểm Đến Được Yêu Thích</h2>
            <p class="section-subtitle">Những địa điểm được nhiều du khách ghé thăm nhất</p>
        </div>
        <div class="dest-grid">
            @foreach($popular as $dest)
            <div class="dest-card">
                <div class="dest-card-img">
                    @if($dest->image)
                        <img src="{{ asset('storage/' . $dest->image) }}" alt="{{ $dest->name }}">
                    @else
                        <div class="img-placeholder">{{ $dest->destinationType->icon ?? '🌏' }}</div>
                    @endif
                    @if($dest->is_featured)
                    <div class="dest-card-badge">
                        <span class="badge badge-orange">⭐ Nổi bật</span>
                    </div>
                    @endif
                    @auth
                    <form method="POST" action="{{ route('favorites.toggle', $dest->id) }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="dest-card-fav" title="Thêm yêu thích">
                            @if($dest->isFavoritedBy(auth()->id()))
                                ❤️
                            @else
                                🤍
                            @endif
                        </button>
                    </form>
                    @endauth
                </div>
                <div class="dest-card-body">
                    <div class="dest-card-type">{{ $dest->destinationType->icon }} {{ $dest->destinationType->name }}</div>
                    <a href="{{ route('destinations.show', $dest->slug) }}" class="dest-card-name">{{ $dest->name }}</a>
                    <div class="dest-card-region">
                        <i class="fas fa-map-marker-alt" style="color:var(--primary);"></i>
                        {{ $dest->region->name }}
                    </div>
                    <div class="dest-card-footer">
                        <span class="dest-card-views">
                            <i class="fas fa-eye"></i> {{ number_format($dest->popularity) }} lượt xem
                        </span>
                        <a href="{{ route('destinations.show', $dest->slug) }}" class="btn btn-primary btn-sm">
                            Xem ngay <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div style="text-align:center;margin-top:2rem;">
            <a href="{{ route('destinations.index') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-map-marker-alt"></i> Xem tất cả điểm đến
            </a>
        </div>
    </div>
</section>

<!-- KHU VỰC -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <div class="badge badge-primary" style="margin-bottom:.75rem;">🗺️ Khu vực</div>
            <h2 class="section-title">Khám Phá Theo Khu Vực</h2>
            <p class="section-subtitle">Tìm điểm đến theo từng tỉnh thành và vùng du lịch</p>
        </div>
        <div class="region-grid">
            @foreach($regions as $region)
            <a href="{{ route('destinations.index') }}?region={{ $region->id }}" style="text-decoration:none;">
                <div class="region-card">
                    @if($region->image)
                        <img src="{{ asset('storage/' . $region->image) }}" alt="{{ $region->name }}">
                    @else
                        <div class="img-placeholder" style="font-size:2.5rem;">🏙️</div>
                    @endif
                    <div class="region-card-overlay">
                        <div class="region-card-name">{{ $region->name }}</div>
                        <div class="region-card-count">{{ $region->destinations_count }} điểm đến</div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA SECTION -->
@guest
<section style="background:linear-gradient(135deg,#0f172a,#0c4a6e);padding:5rem 0;text-align:center;">
    <div class="container">
        <h2 style="font-family:'Playfair Display',serif;font-size:2.25rem;color:white;margin-bottom:1rem;">Bắt Đầu Hành Trình Của Bạn</h2>
        <p style="color:rgba(255,255,255,.7);font-size:1.05rem;max-width:500px;margin:0 auto 2rem;">Đăng ký tài khoản miễn phí để lưu trữ những điểm đến yêu thích và nhận gợi ý phù hợp</p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-user-plus"></i> Đăng ký miễn phí
            </a>
            <a href="{{ route('destinations.index') }}" class="btn btn-outline btn-lg" style="border-color:rgba(255,255,255,.3);">
                <i class="fas fa-search"></i> Khám phá ngay
            </a>
        </div>
    </div>
</section>
@endguest
@endsection
