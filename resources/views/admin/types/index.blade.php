@extends('layouts.admin')
@section('title', 'Quản lý loại hình')
@section('page_title', 'Danh sách loại hình du lịch')

@section('content')
<div class="card">
    <div style="display:flex; justify-content:flex-end; margin-bottom:1.5rem;">
        <a href="{{ route('admin.types.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm loại hình</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Icon</th>
                <th>Tên</th>
                <th>Slug</th>
                <th>Mô tả</th>
                <th>Số điểm đến</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($types as $type)
                <tr>
                    <td style="font-size:1.5rem;">{{ $type->icon ?: '🏷️' }}</td>
                    <td style="font-weight:600;">{{ $type->name }}</td>
                    <td>{{ $type->slug }}</td>
                    <td style="max-width:360px; color:#64748b;">{{ \Illuminate\Support\Str::limit($type->description, 90) }}</td>
                    <td>{{ $type->destinations_count }}</td>
                    <td style="display:flex; gap:.5rem;">
                        <a href="{{ route('admin.types.edit', $type->id) }}" style="color:#0ea5e9;"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.types.destroy', $type->id) }}" method="POST" onsubmit="return confirm('Xóa loại hình này?')">
                            @csrf @method('DELETE')
                            <button type="submit" style="background:none; border:none; color:#ef4444; cursor:pointer;"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top:1rem;">{{ $types->links() }}</div>
</div>
@endsection
