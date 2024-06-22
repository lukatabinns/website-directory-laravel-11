<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Category;

class CategoryController extends Controller
{

    /**
    * Display a listing of categories
    *
    * @param int $id
    * @return JsonResponse
    */ 
    public function index(): JsonResponse
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    /**
    * Store a newly created category
    *
    * @param CategoryRequest $request
    * @return JsonResponse
    */     
    public function store(CategoryRequest $request): JsonResponse
    {
        $input = $request->validated();

        $category = new Category;
        $category->name = $input['name'];
        $category->save();

        return response()->json($category, 201); // 201 Created
    }

    /**
    * Display the specified category
    *
    * @param int $id
    * @return JsonResponse
    */ 
    public function show(int $id): JsonResponse
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    /**
    * Update the specified category
    *
    * @param CategoryRequest $request
    * @return JsonResponse
    */
    public function update(CategoryRequest $request, int $id): JsonResponse
    {
        $input = $request->validated();

        $category = Category::findOrFail($id);
        $category->name = $input['name'];
        $category->save();

        return response()->json($category);
    }

    /**
    * Remove the specified category
    *
    * @param int $id
    * @return JsonResponse
    */
    public function destroy(int $id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'record removed'], 204); // 204 No Content
    }
}
