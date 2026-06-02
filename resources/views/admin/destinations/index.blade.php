@extends('layouts.admin')
@section('title', 'Quản lý điểm đến')
@section('page_title', 'Danh sách điểm đến du lịch')

@section('content')
<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center; gap:1rem; margin-bottom:1.5rem;">
        <form style="display:flex; gap:.5rem; flex-wrap:wrap;">
            <input type="text" name="search" placeholder="Tìm kiếm..." class="btn" style="background:#f1f5f9; border:1px solid var(--border); text-align:left;" value="{{ request('search') }}">
            <select name="region" class="btn" style="background:#f1f5f9; border:1px solid var(--border); text-align:left;">
                <option value="">Tất cả khu vực</option>
                @foreach($regions as $region)
                    <option value="{{ $region->id }}" {{ request('region') == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                @endforeach
            </select>
            <select name="type" class="btn" style="background:#f1f5f9; border:1px solid var(--border); text-align:left;">
                <option value="">Tất cả loại hình</option>
                @foreach($types as $type)
                    <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Lọc</button>
        </form>
        <a href="{{ route('admin.destinations.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm điểm đến</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Ảnh</th>
                <th>Tên điểm đến</th>
                <th>Khu vực</th>
                <th>Loại hình</th>
                <th>Phổ biến</th>
                <th>Nổi bật</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($destinations as $item)
                <tr>
                    <td>
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" style="width:56px; height:42px; object-fit:cover; border-radius:4px;">
                        @else
                            <span style="color:#94a3b8;">-</span>
                        @endif
                    </td>
                    <td style="font-weight:600;">{{ $item->name }}</td>
                    <td>{{ $item->region->name }}</td>
                    <td>{{ $item->destinationType->name }}</td>
                    <td>{{ number_format($item->popularity) }}</td>
                    <td>{!! $item->is_featured ? '<span style="color:#16a34a">⭐</span>' : '-' !!}</td>
                    <td style="display:flex; gap:.5rem;">
                        <a href="{{ route('admin.destinations.show', $item->id) }}" style="color:#16a34a;"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.destinations.edit', $item->id) }}" style="color:#0ea5e9;"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.destinations.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Xóa điểm đến này?')">
                            @csrf @method('DELETE')
                            <button type="submit" style="background:none; border:none; color:#ef4444; cursor:pointer;"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top:1rem;">{{ $destinations->links() }}</div>
</div>
@endsection
