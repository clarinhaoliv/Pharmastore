<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;

class Perfumaria extends Model
{
    protected $fillable = [
        'id_produto', 'lote_fabricacao', 'data_validade'
    ];

    public function produto(){
        return $this->belongsTo(Produto::class,'id_produto' );
    }
}
