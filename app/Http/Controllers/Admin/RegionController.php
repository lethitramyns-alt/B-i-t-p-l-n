<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::withCount('destinations')->latest()->paginate(15);
        return view('admin.regions.index', compact('regions'));
    }

    public function create()
    {
        return view('admin.regions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:regions,name',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('regions', 'public');
        }

        Region::create($validated);

        return redirect()->route('admin.regions.index')
            ->with('success', 'Khu vực đã được thêm thành công!');
    }

    public function edit(Region $region)
    {
        return view('admin.regions.edit', compact('region'));
    }

    public function update(Request $request, Region $region)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:regions,name,' . $region->id,
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            if ($region->image) Storage::disk('public')->delete($region->image);
            $validated['image'] = $request->file('image')->store('regions', 'public');
        }

        $region->update($validated);

        return redirect()->route('admin.regions.index')
            ->with('success', 'Khu vực đã được cập nhật!');
    }

    public function destroy(Region $region)
    {
        if ($region->image) Storage::disk('public')->delete($region->image);
        $region->delete();

        return redirect()->route('admin.regions.index')
            ->with('success', 'Khu vực đã được xóa!');
    }
}
