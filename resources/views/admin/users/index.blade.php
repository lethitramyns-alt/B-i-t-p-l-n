@extends('layouts.admin')
@section('title', 'Quản lý người dùng')
@section('page_title', 'Quản lý tài khoản người dùng')

@section('content')
<div class="card">
    <form style="display:flex; gap:.75rem; align-items:center; margin-bottom:1.5rem;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm theo tên hoặc email" class="btn" style="background:#f1f5f9; border:1px solid var(--border); text-align:left; min-width:260px;">
        <select name="role" class="btn" style="background:#f1f5f9; border:1px solid var(--border); text-align:left;">
            <option value="">Tất cả vai trò</option>
            <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>USER</option>
            <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>ADMIN</option>
        </select>
        <button type="submit" class="btn btn-primary">Lọc</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Email</th>
                <th>Vai trò</th>
                <th>Ngày tham gia</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span style="padding:2px 8px; border-radius:4px; background:{{ $user->role === 'admin' ? '#fef3c7' : '#e0f2fe' }};">
                            {{ strtoupper($user->role) }}
                        </span>
                    </td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                    <td style="display:flex; align-items:center; gap:.5rem;">
                        <a href="{{ route('admin.users.show', $user->id) }}" style="color:#16a34a;"><i class="fas fa-eye"></i></a>

                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" style="display:inline;">
                            @csrf @method('PUT')
                            <select name="role" onchange="this.form.submit()" style="padding:4px; border-radius:4px; border:1px solid var(--border);">
                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>USER</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>ADMIN</option>
                            </select>
                        </form>

                        @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Xóa người dùng này?')">
                                @csrf @method('DELETE')
                                <button type="submit" style="background:none; border:none; color:#ef4444; cursor:pointer;"><i class="fas fa-trash"></i></button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top:1rem;">{{ $users->links() }}</div>
</div>
@endsection
