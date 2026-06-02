@extends('layouts.app')

@section('title', 'Điểm đến yêu thích của tôi')

@push('styles')
<style>
    .page-header { background:linear-gradient(135deg,#be185d,#7c3aed); padding:3rem 0; }
    .page-header h1 { font-family:'Playfair Display',serif; color:white; font-size:2rem; }
    .page-header p { color:rgba(255,255,255,.8); margin-top:.4rem; }

    .fav-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:1.5rem; }
    @media (max-width:1024px) { .fav-grid { grid-template-columns:repeat(2,1fr); } }
    @media (max-width:640px) { .fav-grid { grid-template-columns:1fr; } }

    .fav-card { background:white; border-radius:var(--radius); overflow:hidden; box-shadow:var(--shadow); transition:all .3s; }
    .fav-card:hover { transform:translateY(-5px); box-shadow:var(--shadow-lg); }
    .fav-img { position:relative; height:200px; overflow:hidden; }
    .fav-img img { width:100%; height:100%; object-fit:cover; transition:transform .5s; }
    .fav-card:hover .fav-img img { transform:scale(1.08); }
    .img-ph { background:linear-gradient(135deg,#667eea,#764ba2); display:flex; align-items:center; justify-content:center; color:white; font-size:3rem; width:100%; height:100%; }
    .fav-body { padding:1.25rem; }
    .fav-type { font-size:.75rem; font-weight:600; color:var(--primary); margin-bottom:.25rem; }
    .fav-name { font-size:1rem; font-weight:700; color:var(--dark); text-decoration:none; display:block; margin-bottom:.4rem; }
    .fav-name:hover { color:var(--primary); }
    .fav-region { font-size:.82rem; color:var(--gray); display:flex; align-items:center; gap:.3rem; }
    .fav-footer { display:flex; align-items:center; justify-content:space-between; margin-top:1rem; padding-top:.85rem; border-top:1px solid var(--border); }

    .empty-state { text-align:center; padding:5rem 1rem; }
    .empty-icon { font-size:5rem; margin-bottom:1rem; }
</style>
@endpush

@section('content')
<div class="page-header">
    <div class="container">
        <h1>❤️ Điểm Đến Yêu Thích</h1>
        <p>{{ $favorites->total() }} điểm đến bạn đã lưu</p>
    </div>
</div>

<div class="container" style="padding-top:2rem;">
    @if($favorites->count() > 0)
    <div class="fav-grid">
        @foreach($favorites as $dest)
        <div class="fav-card">
            <div class="fav-img">
                @if($dest->image)
                    <img src="{{ asset('storage/' . $dest->image) }}" alt="{{ $dest->name }}" loading="lazy">
                @else
                    <div class="img-ph">{{ $dest->destinationType->icon ?? '🌏' }}</div>
                @endif
                <form method="POST" action="{{ route('favorites.toggle', $dest->id) }}" style="position:absolute;top:.75rem;right:.75rem;">
                    @csrf
                    <button type="submit" style="width:36px;height:36px;background:rgba(255,255,255,.9);border-radius:50%;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:1rem;" title="Bỏ yêu thích">
                        ❤️
                    </button>
                </form>
            </div>
            <div class="fav-body">
                <div class="fav-type">{{ $dest->destinationType->icon }} {{ $dest->destinationType->name }}</div>
                <a href="{{ route('destinations.show', $dest->slug) }}" class="fav-name">{{ $dest->name }}</a>
                <div class="fav-region">
                    <i class="fas fa-map-marker-alt" style="color:var(--primary);"></i> {{ $dest->region->name }}
                </div>
                <div class="fav-footer">
                    <span style="font-size:.8rem;color:var(--gray);"><i class="fas fa-eye"></i> {{ number_format($dest->popularity) }}</span>
                    <a href="{{ route('destinations.show', $dest->slug) }}" class="btn btn-primary btn-sm">
                        Xem chi tiết <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- PAGINATION -->
    @if($favorites->hasPages())
    <div class="pagination" style="margin:2rem 0;">
        @foreach($favorites->links()->elements as $element)
            @if(is_string($element))
                <span class="page-btn" style="opacity:.4;">{{ $element }}</span>
            @endif
            @if(is_array($element))
                @foreach($element as $page => $url)
                    <a href="{{ $url }}" class="page-btn {{ $favorites->currentPage() == $page ? 'active' : '' }}">{{ $page }}</a>
                @endforeach
            @endif
        @endforeach
    </div>
    @endif

    @else
    <div class="empty-state">
        <div class="empty-icon">💔</div>
        <h3 style="font-size:1.5rem;font-weight:700;color:var(--dark);margin-bottom:.75rem;">Chưa có điểm đến yêu thích</h3>
        <p style="color:var(--gray);max-width:400px;margin:0 auto 2rem;">Hãy khám phá và lưu những điểm đến bạn muốn đến thăm!</p>
        <a href="{{ route('destinations.index') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-map-marker-alt"></i> Khám phá điểm đến
        </a>
    </div>
    @endif
</div>
@endsection
