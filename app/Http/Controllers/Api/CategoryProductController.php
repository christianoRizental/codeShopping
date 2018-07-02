<?php

namespace CodeShopping\Http\Controllers\Api;

use CodeShopping\Http\Controllers\Controller;
use CodeShopping\Http\Requests\CategoryProductRequest;
use CodeShopping\Http\Resources\CategoryProductResource;
use CodeShopping\Models\Category;
use CodeShopping\Models\Product;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    public function index(Category $category)
    {
        return new CategoryProductResource($category);
    }

    public function store(CategoryProductRequest $request, Category $categroy)
    {
        //sincroniza
        $changed = $category->products()->sync($request->products);
        //pega somente os que foram adicionados
        $productsAttachedId = $changed['attached'];
        //Consulta na base
        /** @var Collection $products */
        $products = Product::whereIn('id', $productsAttachedId)->get();; //where id in (1,3)
        //retorna as categorias ou vazio
        return $products->count() ? response()->json($products, 201) : [];
    }

    public function destroy(Category $category, Product $product)
    {
        $cagtegory->products()->detach($product->id);
        return response()->json([], 204);
    }
}
