<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Services\FileManager;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Category::class);

        return view('dashboard.category.index', [
            'categories' => Category::withCount(['children'])->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.category.create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request, FileManager $fileManager)
    {
        $image = $fileManager->upload($request->file('image'), 'categories');

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-', null),
            'image' => $image,
            'parent_id' => $request->parent_id  ?? null,
        ]);

        return to_route('dashboard.category.index')->with('success', __('Category created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        Gate::authorize('view', $category);

        return view('dashboard.category.show', [
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        Gate::authorize('update', $category);

        return view('dashboard.category.edit', [
            'category' => $category,
            'categories' => Category::where('id', '!=', $category->id)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category, FileManager $fileManager)
    {
        if($request->has('image')){
            $fileManager->delete($category->image);
            $image = $fileManager->upload($request->file('image'), 'categories');
        }

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-', null),
            'image' => $image ?? $category->image,
            'parent_id' => $request->parent_id  ?? null,
        ]);

        return to_route('dashboard.category.index')->with('success', __('Category updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Gate::authorize('delete', $category);

        $category->delete();

        return to_route('dashboard.category.index')->with('success', __('Category deleted successfully.'));
    }
}
