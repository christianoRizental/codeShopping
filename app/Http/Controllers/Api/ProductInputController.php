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
        //with -> acessa menos o banco de dados
        $inputs = ProductInput::with('product')->paginate(); //eager loading/ carregamento prematuro
        return ProductInputResource::collection($inputs);
    }

    public function store(ProductInputRequest $request)
    {
        $input = ProductInput::create($request->all());
        //$product = $input->product;
        //$product->stock += $input->amount;
        //$product->save();
        //codigo acima foi colocado no evento da criação da entrada no AppServiceProvider
        //evento é algo que ocorreu - vigia - executar algo -> tarefas
        //não vai só atualizar o estoque
        //pode enviar e-mail pra gestor/gerente
        //alguma outra tarefa
        //outra tarefa ainda
        //mais outra tarefa
        return new ProductInputResource($input);
    }

    public function show(ProductInput $input) //criamos o recurso como inputs então usar $input no singular
    {
        return new ProductInputResource($input);
    }
}
