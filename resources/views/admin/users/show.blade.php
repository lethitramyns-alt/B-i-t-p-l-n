@extends('layouts.admin')
@section('title', 'Chi tiết người dùng')
@section('page_title', 'Người dùng: ' . $user->name)

@section('content')
<div style="display:grid; grid-template-columns:.8fr 1.2fr; gap:1.5rem;">
    <div class="card">
        <div style="width:72px; height:72px; border-radius:50%; background:linear-gradient(135deg,#0ea5e9,#10b981); color:white; display:flex; align-items:center; justify-content:center; font-size:1.75rem; font-weight:700; margin-bottom:1rem;">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <h2 style="margin-bottom:.5rem;">{{ $user->name }}</h2>
        <div style="color:#64748b; margin-bottom:1rem;">{{ $user->email }}</div>

        <div style="display:grid; gap:.75rem;">
            <div><strong>Vai trò:</strong> {{ strtoupper($user->role) }}</div>
            <div><strong>Số điện thoại:</strong> {{ $user->phone ?: 'Chưa cập nhật' }}</div>
            <div><strong>Email xác thực:</strong> {{ $user->email_verified_at ? $user->email_verified_at->format('d/m/Y H:i') : 'Chưa xác thực' }}</div>
            <div><strong>Ngày tham gia:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</div>
        </div>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" style="margin-top:1.5rem; display:flex; gap:.75rem;">
            @csrf @method('PUT')
            <select name="role" class="btn" style="background:#f1f5f9; border:1px solid var(--border);">
                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>USER</option>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>ADMIN</option>
            </select>
            <button type="submit" class="btn btn-primary">Cập nhật vai trò</button>
        </form>
    </div>

    <div class="card">
        <h3 style="margin-bottom:1rem;">Điểm đến yêu thích</h3>
        @if($user->favoriteDestinations->count() > 0)
            <table class="table">
                <thead><tr><th>Tên</th><th>Khu vực</th><th>Loại hình</th><th></th></tr></thead>
                <tbody>
                    @foreach($user->favoriteDestinations as $destination)
                        <tr>
                            <td>{{ $destination->name }}</td>
                            <td>{{ $destination->region->name }}</td>
                            <td>{{ $destination->destinationType->icon }} {{ $destination->destinationType->name }}</td>
                            <td><a href="{{ route('destinations.show', $destination->slug) }}" target="_blank" style="color:#0ea5e9;"><i class="fas fa-external-link-alt"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color:#64748b;">Người dùng này chưa lưu điểm đến yêu thích.</p>
        @endif
    </div>
</div>

<div style="margin-top:1rem;">
    <a href="{{ route('admin.users.index') }}" class="btn" style="background:#e2e8f0;">Quay lại</a>
</div>
@endsection
