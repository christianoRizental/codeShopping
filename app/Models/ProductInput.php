<?php

namespace CodeShopping\Models;

use Illuminate\Database\Eloquent\Model;

class ProductInput extends Model
{
    protected $fillable = ['amount', 'product_id'];
    
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
//select * from product_inputs
//cada vez que eu acesso o relacionamento eu  vou gerar uma consulta no banco de dados para pegara as entradas