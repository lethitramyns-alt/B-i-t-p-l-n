@extends('layouts.admin')
@section('title', 'Quản lý khu vực')
@section('page_title', 'Danh sách khu vực du lịch')

@section('content')
<div class="card">
    <div style="display:flex; justify-content:flex-end; margin-bottom:1.5rem;">
        <a href="{{ route('admin.regions.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm khu vực</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Ảnh</th>
                <th>Tên</th>
                <th>Slug</th>
                <th>Số điểm đến</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($regions as $item)
                <tr>
                    <td>
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" style="width:56px; height:40px; object-fit:cover; border-radius:4px;">
                        @else
                            <span style="color:#94a3b8;">-</span>
                        @endif
                    </td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>{{ $item->destinations_count }}</td>
                    <td style="display:flex; gap:.5rem;">
                        <a href="{{ route('admin.regions.edit', $item->id) }}" style="color:#0ea5e9;"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.regions.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Xóa khu vực này?')">
                            @csrf @method('DELETE')
                            <button type="submit" style="background:none; border:none; color:#ef4444; cursor:pointer;"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top:1rem;">{{ $regions->links() }}</div>
</div>
@endsection
