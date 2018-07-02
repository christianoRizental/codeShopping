<?php

namespace CodeShopping\Http\Controllers\Api;

use CodeShopping\Http\Controllers\Controller;
use CodeShopping\Http\Requests\ProductRequest;
use CodeShopping\Http\Resources\ProductResource;
use CodeShopping\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        //return Product::all();
        $products = Product::paginate(10);
        return ProductResource::collection($products);
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->all());
        $product->refresh(); //atualiza as informações par mostrar todos os campos no retorno
        return new ProductResource($products);
    }

    public function show(Product $product)
    {
        return new ProductResource($products);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->fill($request->all());
        $product->save();
        
        return new ProductResource($products);
        //return response([], 204);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        
        return response()->json([], 204);
    }
}
