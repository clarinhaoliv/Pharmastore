<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;

class Medicamento extends Model
{
    protected $fillable = [
        'id_produto', 'lote_fabricacao', 'data_validade', 'principio_ativo', 'medicamento_controlado'
    ];

    protected $casts = [
        'data_validade' => 'date',
        'medicamento_controlado' => 'boolean',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'id_produto');
    }
}
