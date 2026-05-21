<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Fornecedores;

class Produto extends Model
{
    protected $fillable = [
        'id_fornecedor', 'nome', 'preço', 'quantidade', 'estoque_minimo', 'categoria'
    ];

    public function fornecedor(){
        return $this->belongsTo(Fornecedores::class, 'id_fornecedor');
    }
}
