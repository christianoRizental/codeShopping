<?php

namespace CodeShopping\Http\Controllers\Api;

use CodeShopping\Http\Controllers\Controller;
use CodeShopping\Http\Requests\ProductCategoryRequest;
use CodeShopping\Http\Resources\ProductCategoryResource;
use CodeShopping\Models\Category;
use CodeShopping\Models\Product;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index(Product $product)
    {
        //return $product->categories; 
        
        //retorna os produtos e depois as categorias
        //Criar serializacao de produtos e em seguida as categorias
        return new ProductCategoryResource($product);
    }

    //categories
    //sync em vez de attach
    //produto 1 esteja relacionado com 10 categorias
    // quero relacinar somente com 2 categorias 1 e 3
    // sync substituiu o detach e attach
    public function store(ProductCategoryRequest $request, Product $product)
    {
        //sincroniza
        $changed = $product->categories()->sync($request->categories);
        //pega somente os que foram adicionados
        $categoriesAttachedId = $changed['attached'];
        //Consulta na base
        /** @var Collection $categories */
        $categories = Category::whereIn('id', $categoriesAttachedId)->get();; //where id in (1,3)
        //retorna as categorias ou vazio
        return $categories->count() ? response()->json($categories, 201) : [];
    }

    public function destroy(Product $product, Category $category)
    {
        $product->categories()->detach($category->id);
        return response()->json([], 204);
    }
}
