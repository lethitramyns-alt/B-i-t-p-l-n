<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DestinationType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DestinationTypeController extends Controller
{
    public function index()
    {
        $types = DestinationType::withCount('destinations')->latest()->paginate(15);
        return view('admin.types.index', compact('types'));
    }

    public function create()
    {
        return view('admin.types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:destination_types,name',
            'icon'        => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        DestinationType::create($validated);

        return redirect()->route('admin.types.index')
            ->with('success', 'Loại hình đã được thêm thành công!');
    }

    public function edit(DestinationType $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    public function update(Request $request, DestinationType $type)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:destination_types,name,' . $type->id,
            'icon'        => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $type->update($validated);

        return redirect()->route('admin.types.index')
            ->with('success', 'Loại hình đã được cập nhật!');
    }

    public function destroy(DestinationType $type)
    {
        $type->delete();
        return redirect()->route('admin.types.index')
            ->with('success', 'Loại hình đã được xóa!');
    }
}
