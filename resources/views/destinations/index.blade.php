@extends('layouts.app')

@section('title', 'Tất cả điểm đến')

@push('styles')
<style>
    .page-header { background: linear-gradient(135deg, #0f172a, #0c4a6e); padding: 3rem 0; }
    .page-header h1 { font-family:'Playfair Display',serif; color:white; font-size:2.25rem; }
    .page-header p { color:rgba(255,255,255,.7); margin-top:.5rem; }

    .filter-bar { background:white; border-radius:var(--radius); padding:1.25rem; box-shadow:var(--shadow); margin:-1.5rem 0 2rem; position:relative; z-index:10; }
    .filter-form { display:flex; gap:1rem; align-items:flex-end; flex-wrap:wrap; }
    .filter-group { flex:1; min-width:180px; }
    .filter-group label { font-size:.8rem; font-weight:600; color:var(--gray); display:block; margin-bottom:.4rem; text-transform:uppercase; letter-spacing:.5px; }

    .dest-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:1.5rem; }
    @media (max-width:1024px) { .dest-grid { grid-template-columns:repeat(2,1fr); } }
    @media (max-width:640px) { .dest-grid { grid-template-columns:1fr; } }

    .dest-card { background:white; border-radius:var(--radius); overflow:hidden; box-shadow:var(--shadow); transition:all .3s; }
    .dest-card:hover { transform:translateY(-6px); box-shadow:var(--shadow-lg); }
    .dest-img { position:relative; height:220px; overflow:hidden; }
    .dest-img img, .dest-img .img-ph { width:100%; height:100%; object-fit:cover; transition:transform .5s; }
    .dest-card:hover .dest-img img { transform:scale(1.08); }
    .img-ph { background:linear-gradient(135deg,#667eea,#764ba2); display:flex; align-items:center; justify-content:center; color:white; font-size:3rem; }
    .fav-btn {
        position:absolute; top:.75rem; right:.75rem;
        width:36px; height:36px; background:rgba(255,255,255,.9);
        border-radius:50%; border:none; cursor:pointer;
        display:flex; align-items:center; justify-content:center;
        font-size:1rem; transition:all .2s;
    }
    .fav-btn:hover { background:white; transform:scale(1.1); }
    .dest-body { padding:1.25rem; }
    .dest-type { font-size:.75rem; font-weight:600; color:var(--primary); margin-bottom:.25rem; }
    .dest-name { font-size:1.05rem; font-weight:700; color:var(--dark); margin-bottom:.4rem; text-decoration:none; display:block; }
    .dest-name:hover { color:var(--primary); }
    .dest-region { font-size:.82rem; color:var(--gray); display:flex; align-items:center; gap:.3rem; margin-bottom:.75rem; }
    .dest-desc { font-size:.85rem; color:var(--gray); line-height:1.6; }
    .dest-footer { display:flex; align-items:center; justify-content:space-between; margin-top:1rem; padding-top:.85rem; border-top:1px solid var(--border); }
    .dest-views { font-size:.8rem; color:var(--gray); display:flex; align-items:center; gap:.3rem; }

    .no-results { text-align:center; padding:5rem 1rem; color:var(--gray); }
    .no-results-icon { font-size:4rem; margin-bottom:1rem; }
    .active-filters { display:flex; gap:.5rem; flex-wrap:wrap; margin-bottom:1.5rem; }
    .filter-tag { display:flex; align-items:center; gap:.4rem; padding:.3rem .75rem; background:#dbeafe; color:#1d4ed8; border-radius:999px; font-size:.8rem; font-weight:500; }
    .filter-tag a { color:#1d4ed8; text-decoration:none; margin-left:.2rem; font-weight:700; }
</style>
@endpush

@section('content')
<div class="page-header">
    <div class="container">
        <h1>🗺️ Điểm Đến Du Lịch</h1>
        <p>Khám phá {{ $destinations->total() }} điểm đến tuyệt vời trên khắp Việt Nam</p>
    </div>
</div>

<div class="container">
    <!-- FILTER BAR -->
    <div class="filter-bar">
        <form class="filter-form" method="GET" action="{{ route('destinations.index') }}" id="filterForm">
            <div class="filter-group">
                <label>🔍 Từ khóa</label>
                <input type="text" name="search" class="form-control" placeholder="Tên điểm đến..." value="{{ request('search') }}">
            </div>
            <div class="filter-group">
                <label>🗺️ Khu vực</label>
                <select name="region" class="form-control">
                    <option value="">Tất cả khu vực</option>
                    @foreach($regions as $region)
                    <option value="{{ $region->id }}" {{ request('region') == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-group">
                <label>🏷️ Loại hình</label>
                <select name="type" class="form-control">
                    <option value="">Tất cả loại hình</option>
                    @foreach($types as $type)
                    <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>{{ $type->icon }} {{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Tìm kiếm
                </button>
                @if(request()->hasAny(['search','region','type']))
                <a href="{{ route('destinations.index') }}" class="btn btn-outline" style="color:var(--gray);border-color:var(--border);margin-left:.5rem;">
                    <i class="fas fa-times"></i> Xóa lọc
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- ACTIVE FILTERS -->
    @if(request()->hasAny(['search','region','type']))
    <div class="active-filters">
        @if(request('search'))
        <div class="filter-tag">🔍 "{{ request('search') }}"<a href="{{ request()->fullUrlWithoutQuery('search') }}">×</a></div>
        @endif
        @if(request('region'))
        @php $r = $regions->find(request('region')); @endphp
        @if($r)
        <div class="filter-tag">🗺️ {{ $r->name }}<a href="{{ request()->fullUrlWithoutQuery('region') }}">×</a></div>
        @endif
        @endif
        @if(request('type'))
        @php $t = $types->find(request('type')); @endphp
        @if($t)
        <div class="filter-tag">🏷️ {{ $t->name }}<a href="{{ request()->fullUrlWithoutQuery('type') }}">×</a></div>
        @endif
        @endif
    </div>
    @endif

    <!-- DESTINATIONS GRID -->
    @if($destinations->count() > 0)
    <div class="dest-grid">
        @foreach($destinations as $dest)
        <div class="dest-card">
            <div class="dest-img">
                @if($dest->image)
                    <img src="{{ asset('storage/' . $dest->image) }}" alt="{{ $dest->name }}" loading="lazy">
                @else
                    <div class="img-ph">{{ $dest->destinationType->icon ?? '🌏' }}</div>
                @endif
                @if($dest->is_featured)
                <div style="position:absolute;top:.75rem;left:.75rem;">
                    <span class="badge badge-orange">⭐ Nổi bật</span>
                </div>
                @endif
                @auth
                <form method="POST" action="{{ route('favorites.toggle', $dest->id) }}" style="position:absolute;top:.75rem;right:.75rem;">
                    @csrf
                    <button type="submit" class="fav-btn" title="{{ $dest->isFavoritedBy(auth()->id()) ? 'Bỏ yêu thích' : 'Thêm yêu thích' }}">
                        {{ $dest->isFavoritedBy(auth()->id()) ? '❤️' : '🤍' }}
                    </button>
                </form>
                @endauth
            </div>
            <div class="dest-body">
                <div class="dest-type">{{ $dest->destinationType->icon }} {{ $dest->destinationType->name }}</div>
                <a href="{{ route('destinations.show', $dest->slug) }}" class="dest-name">{{ $dest->name }}</a>
                <div class="dest-region">
                    <i class="fas fa-map-marker-alt" style="color:var(--primary);"></i>
                    {{ $dest->region->name }}
                </div>
                <p class="dest-desc">{{ Str::limit($dest->description, 90) }}</p>
                <div class="dest-footer">
                    <span class="dest-views">
                        <i class="fas fa-eye"></i> {{ number_format($dest->popularity) }}
                    </span>
                    <a href="{{ route('destinations.show', $dest->slug) }}" class="btn btn-primary btn-sm">
                        Xem chi tiết <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- PAGINATION -->
    <div class="pagination" style="margin:2.5rem 0;">
        @if($destinations->onFirstPage())
            <span class="page-btn" style="opacity:.4;cursor:not-allowed;">‹ Trước</span>
        @else
            <a href="{{ $destinations->previousPageUrl() }}" class="page-btn">‹ Trước</a>
        @endif

        @foreach($destinations->getUrlRange(max(1,$destinations->currentPage()-2), min($destinations->lastPage(),$destinations->currentPage()+2)) as $page => $url)
            <a href="{{ $url }}" class="page-btn {{ $destinations->currentPage() == $page ? 'active' : '' }}">{{ $page }}</a>
        @endforeach

        @if($destinations->hasMorePages())
            <a href="{{ $destinations->nextPageUrl() }}" class="page-btn">Tiếp ›</a>
        @else
            <span class="page-btn" style="opacity:.4;cursor:not-allowed;">Tiếp ›</span>
        @endif
    </div>

    @else
    <div class="no-results">
        <div class="no-results-icon">🔍</div>
        <h3 style="font-size:1.25rem;color:var(--dark);margin-bottom:.5rem;">Không tìm thấy điểm đến</h3>
        <p>Hãy thử tìm kiếm với từ khóa khác hoặc xóa bộ lọc</p>
        <a href="{{ route('destinations.index') }}" class="btn btn-primary" style="margin-top:1.5rem;">
            <i class="fas fa-list"></i> Xem tất cả điểm đến
        </a>
    </div>
    @endif
</div>
@endsection
