<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Support\Str;
use App\Services\FileManager;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Brand::class);

        return view('dashboard.brand.index', [
            'brands' => Brand::withCount(['products'])->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request, FileManager $fileManager)
    {
        $image = $fileManager->upload($request->file('image'), 'brands');

        Brand::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-', null),
            'image' => $image,
        ]);

        return to_route('dashboard.brand.index')->with('success', __('Brand created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        Gate::authorize('view', $brand);

        return view('dashboard.brand.show', [
            'brand' => $brand,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        Gate::authorize('update', $brand);

        return view('dashboard.brand.edit', [
            'brand' => $brand,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand, FileManager $fileManager)
    {
        if($request->has('image')){
            $fileManager->delete($brand->image);
            $image = $fileManager->upload($request->file('image'), 'brands');
        }

        $brand->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-', null),
            'image' => $image ?? $brand->image,
        ]);

        return to_route('dashboard.brand.index')->with('success', __('Brand updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        Gate::authorize('delete', $brand);

        $brand->delete();

        return to_route('dashboard.brand.index')->with('success', __('Brand deleted successfully.'));
    }
}
