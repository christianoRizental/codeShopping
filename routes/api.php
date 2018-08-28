<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//fez um group para renomear a rota, para adicionar api na rota, e criou um alisa api.
Route::group(['namespace' => 'Api', 'as' => 'api.'],  function(){
    //endpoints personalizados colocar acima dos resouces
    Route::name('login')->post('login', 'AuthController@login');
    Route::name('refresh')->post('refresh', 'AuthController@refresh');
    
    Route::group(['middleware' => ['auth:api','jwt.refresh']], function(){
        Route::name('logout')->post('logout', 'AuthController@logout');
        Route::name('me')->get('me','AuthController@me');
        Route::patch('products/{product}/restore', 'ProductController@restore');
        Route::resource('products', 'ProductController', ['except' => ['create','edit']]);
        Route::resource('categories', 'CategoryController', ['except' => ['create','edit']]);
        //resource nested - recusro filho
        //POST products/1/categories inserindo categorias no produto 1
        //PUT products/1/categories - adicionar e remover ao mesmo tempo, exclui as anteriores e grava as novas
        //GET products/1/categories - quais as categorias estao relacionadas com o produto 1
        //DELETE products/1/categories - removendo todas as cetegorias
        //DELETE products/1/categories/10 - deletando a categoria 10 do produto 1
        //Route::resource('products.categories');
        Route::resource('products.categories', 'ProductCategoryController', ['only' => ['index','store','destroy']]);
        Route::resource('products.photos', 'ProductPhotoController', ['except' => ['create','edit']]);
        Route::resource('categories.products', 'CategoryProductController', ['only' => ['index','store','destroy']]);
        Route::resource('inputs', 'ProductInputController', ['only' => ['index','store','show']]);
        Route::resource('outputs', 'ProductOutputController', ['only' => ['index','store','show']]);
        Route::resource('users', 'UserController', ['except' => ['create','edit']]);
    });
});