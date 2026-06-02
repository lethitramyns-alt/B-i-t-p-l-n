@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page_title', 'Tổng quan hệ thống')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background: #e0f2fe; color: #0ea5e9;"><i class="fas fa-map-marker-alt"></i></div>
        <div><div style="font-size: 1.5rem; font-weight: 700;">{{ $stats['destinations'] }}</div><div style="font-size: .8rem; color: #64748b;">Điểm đến</div></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: #fef3c7; color: #d97706;"><i class="fas fa-heart"></i></div>
        <div><div style="font-size: 1.5rem; font-weight: 700;">{{ $stats['favorites'] }}</div><div style="font-size: .8rem; color: #64748b;">Lượt yêu thích</div></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: #dcfce7; color: #16a34a;"><i class="fas fa-users"></i></div>
        <div><div style="font-size: 1.5rem; font-weight: 700;">{{ $stats['users'] }}</div><div style="font-size: .8rem; color: #64748b;">Thành viên</div></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: #f3e8ff; color: #9333ea;"><i class="fas fa-layer-group"></i></div>
        <div><div style="font-size: 1.5rem; font-weight: 700;">{{ $stats['regions'] }}</div><div style="font-size: .8rem; color: #64748b;">Khu vực</div></div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
    <div class="card">
        <h3 style="margin-bottom: 1rem;">Top điểm đến phổ biến</h3>
        <table class="table">
            <thead><tr><th>Tên</th><th>Khu vực</th><th>Lượt xem</th></tr></thead>
            <tbody>
                @foreach($topDestinations as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->region->name }}</td>
                    <td>{{ number_format($item->popularity) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card">
        <h3 style="margin-bottom: 1rem;">Thành viên mới</h3>
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            @foreach($recentUsers as $user)
            <div style="display: flex; align-items: center; gap: .75rem;">
                <div style="width: 32px; height: 32px; background: #eee; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700;">{{ substr($user->name, 0, 1) }}</div>
                <div>
                    <div style="font-size: .9rem; font-weight: 600;">{{ $user->name }}</div>
                    <div style="font-size: .75rem; color: #64748b;">{{ $user->email }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
