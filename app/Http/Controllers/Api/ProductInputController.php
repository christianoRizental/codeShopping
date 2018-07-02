<?php

namespace CodeShopping\Http\Controllers\Api;

use CodeShopping\Http\Controllers\Controller;
use CodeShopping\Http\Requests\ProductInputRequest;
use CodeShopping\Http\Resources\ProductInputResource;
use CodeShopping\Models\ProductInput;
use Illuminate\Http\Request;

class ProductInputController extends Controller
{
    public function index()
    {
        //whit -> acessa menos o banco de dados
        $inputs = ProductInput::whit('product')->paginate(); //eager loading/ carregamento prematuro
        return ProductInputResource::collection($inputs);
    }

    public function store(ProductInputRequest $request)
    {
        $input = ProductInput::create($request->all());
        $product = $input->product;
        $product->stock += $input->amount;
        $product->save();
        return new ProductInputResource($input);
    }

    public function show(ProductInput $input) //criamos o recurso como inputs então usar $input no singular
    {
        return new ProductInputResource($input);
    }
}
