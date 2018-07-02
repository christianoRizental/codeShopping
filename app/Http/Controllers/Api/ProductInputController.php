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
        //
    }

    public function create()
    {
        //
    }

    public function store(ProductInputRequest $request)
    {
        $productInput = ProductInput::create($request->all());
        $productInput->refresh(); //atualiza as informações par mostrar todos os campos no retorno
        return new ProductInputResource($productInput);
    }

    public function show(ProductInput $productInput)
    {
        //
    }

    public function edit(ProductInput $productInput)
    {
        //
    }

    public function update(Request $request, ProductInput $productInput)
    {
        //
    }

    public function destroy(ProductInput $productInput)
    {
        //
    }
}
