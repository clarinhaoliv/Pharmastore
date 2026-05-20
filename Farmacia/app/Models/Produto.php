<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Fornecedores;

class Produto extends Model
{
    protected $fillable = [
        'id_fornecedor', 'Nome', 'Preço', 'Quantidade', 'estoque_minimo', 'Categoria'
    ];

    public function fornecedores(){
        return $this->belongsTo(Fornecedores::class, 'id_fornecedor');
    }
}
