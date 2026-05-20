<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;

class Perfumaria extends Model
{
    protected $fillable = [
        'id_produto', 'Lote de Fabricação', 'Data de Validade'
    ];

    public function produto(){
        return $this->belongsTo(Produto::class,'id_produto' );
    }
}
