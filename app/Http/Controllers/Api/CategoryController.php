<?php

namespace CodeShopping\Http\Controllers\Api;

use CodeShopping\Http\Controllers\Controller;
use CodeShopping\Http\Requests\CategoryRequest;
use CodeShopping\Http\Resources\CategoryResource;
use CodeShopping\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = $request->has('all') ? Category::all() : Category::paginate(5);
        return CategoryResource::collection($categories);
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
