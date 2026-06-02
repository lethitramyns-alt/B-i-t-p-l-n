<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Region;
use App\Models\DestinationType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $query = Destination::with(['region', 'destinationType'])->latest();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('region')) {
            $query->where('region_id', $request->region);
        }
        if ($request->filled('type')) {
            $query->where('destination_type_id', $request->type);
        }

        $destinations = $query->paginate(15)->withQueryString();
        $regions = Region::all();
        $types = DestinationType::all();

        return view('admin.destinations.index', compact('destinations', 'regions', 'types'));
    }

    public function create()
    {
        $regions = Region::all();
        $types = DestinationType::all();
        return view('admin.destinations.create', compact('regions', 'types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                => 'required|string|max:255|unique:destinations,name',
            'region_id'           => 'required|exists:regions,id',
            'destination_type_id' => 'required|exists:destination_types,id',
            'description'         => 'required|string',
            'tips'                => 'nullable|string',
            'address'             => 'nullable|string|max:500',
            'latitude'            => 'nullable|numeric|between:-90,90',
            'longitude'           => 'nullable|numeric|between:-180,180',
            'image'               => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'gallery'             => 'nullable|array',
            'gallery.*'           => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'is_featured'         => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('destinations', 'public');
        }

        if ($request->hasFile('gallery')) {
            $gallery = [];
            foreach ($request->file('gallery') as $file) {
                $gallery[] = $file->store('destinations/gallery', 'public');
            }
            $validated['gallery'] = $gallery;
        }

        Destination::create($validated);

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Điểm đến đã được thêm thành công!');
    }

    public function show(Destination $destination)
    {
        $destination->load(['region', 'destinationType']);

        return view('admin.destinations.show', compact('destination'));
    }

    public function edit(Destination $destination)
    {
        $regions = Region::all();
        $types = DestinationType::all();
        return view('admin.destinations.edit', compact('destination', 'regions', 'types'));
    }

    public function update(Request $request, Destination $destination)
    {
        $validated = $request->validate([
            'name'                => 'required|string|max:255|unique:destinations,name,' . $destination->id,
            'region_id'           => 'required|exists:regions,id',
            'destination_type_id' => 'required|exists:destination_types,id',
            'description'         => 'required|string',
            'tips'                => 'nullable|string',
            'address'             => 'nullable|string|max:500',
            'latitude'            => 'nullable|numeric|between:-90,90',
            'longitude'           => 'nullable|numeric|between:-180,180',
            'image'               => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'gallery'             => 'nullable|array',
            'gallery.*'           => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'remove_gallery'      => 'nullable|array',
            'remove_gallery.*'    => 'string',
            'is_featured'         => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $removeGallery = $validated['remove_gallery'] ?? [];
        unset($validated['remove_gallery']);

        if ($request->hasFile('image')) {
            if ($destination->image) Storage::disk('public')->delete($destination->image);
            $validated['image'] = $request->file('image')->store('destinations', 'public');
        }

        if (! empty($removeGallery) || $request->hasFile('gallery')) {
            $gallery = $destination->gallery ?? [];

            if (! empty($removeGallery)) {
                $pathsToRemove = array_values(array_intersect($gallery, $removeGallery));

                $gallery = collect($gallery)
                    ->reject(fn ($path) => in_array($path, $pathsToRemove, true))
                    ->values()
                    ->all();

                foreach ($pathsToRemove as $path) {
                    Storage::disk('public')->delete($path);
                }
            }

            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $file) {
                    $gallery[] = $file->store('destinations/gallery', 'public');
                }
            }

            $validated['gallery'] = $gallery ?: null;
        }

        $destination->update($validated);

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Điểm đến đã được cập nhật!');
    }

    public function destroy(Destination $destination)
    {
        if ($destination->image) Storage::disk('public')->delete($destination->image);
        if ($destination->gallery) {
            foreach ($destination->gallery as $img) {
                Storage::disk('public')->delete($img);
            }
        }
        $destination->delete();

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Điểm đến đã được xóa!');
    }
}
