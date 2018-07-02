<?php

namespace CodeShopping\Http\Controllers\Api;

use CodeShopping\Http\Controllers\Controller;
use CodeShopping\Http\Requests\CategoryRequest;
use CodeShopping\Http\Resources\CategoryResource;
use CodeShopping\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        //return Category::all();
        return CategoryResource::collection(Category::all());
    }
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->all());
        $category->refresh();
        return new CategoryResource($category);
    }
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }
    public function update(CategoryRequest $request, Category $category)
    {
        $category->fill($request->all());
        $category->save();
        
        return $category;
        //return response([], 204);
    }
    //conceito é chamdo de Route model binding
    //duas maneiras de utilizar
    //   implicita, escondida - é o que nós já usamos no código
    //   explicita, 

    public function destroy(Category $category)
    {
        $category->delete();
        
        return response()->json([], 204);
    }
}
