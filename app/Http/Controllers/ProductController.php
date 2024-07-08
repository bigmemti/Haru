<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Services\FileManager;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Product::class);

        return view('dashboard.product.index', [
            'products' => Product::with(['category', 'brand'])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.product.create', [
            'categories' => Category::all(),
            'brands' => Brand::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request, FileManager $fileManager)
    {
        $image = $fileManager->upload($request->file('image'), 'products');

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-', null),
            'image' => $image,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return to_route('dashboard.product.index')->with('success', __('Product created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        Gate::authorize('view', $product);

        return view('dashboard.product.show', [
            'product' => $product->load('category', 'brand'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        Gate::authorize('update', $product);

        return view('dashboard.product.edit', [
            'product' => $product,
            'categories' => Category::all(),
            'brands' => Brand::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product, FileManager $fileManager)
    {
        if($request->has('image')){
            $fileManager->delete($product->image);
            $image = $fileManager->upload($request->file('image'), 'products');
        }

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-', null),
            'image' => $image ?? $product->image,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return to_route('dashboard.product.index')->with('success', __('Product updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Gate::authorize('delete', $product);

        $product->delete();

        return to_route('dashboard.product.index')->with('success', __('Product deleted successfully.'));
    }
}
