<?php

namespace App\Http\Controllers\Category;

use App\Actions\Category\CategoryCreateAction;
use App\Actions\Category\CategoryUpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Log;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with(['posts'])->get();

        Log::debug('Categories were listed');

        return CategoryResource::collection($categories);
    }


    /**
     * Store a newly created resource in storage.
     * @throws \Throwable
     */
    public function store(CategoryRequest $request, CategoryCreateAction $action)
    {
        $category = DB::transaction(fn() => $action->handle($request));

        return CategoryResource::make($category);
    }


    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->load(['posts']);

        Log::debug('Category found with id: ' . $category->id);

        return CategoryResource::make($category);
    }


    /**
     * Update the specified resource in storage.
     * @throws \Throwable
     */
    public function update(Category $category, CategoryRequest $request, CategoryUpdateAction $action)
    {
        $category = DB::transaction(fn() => $action->handle($request, $category));

        return CategoryResource::make($category);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->posts()->exists()) {
            return response()->json(['message' => 'Could not delete Category because posts exist for this category']);
        }

        $category->delete();

        Log::debug('Category deleted with id: ' . $category->id);

        return response()->json(['message' => 'Category deleted with id: ' . $category->id]);
    }
}
