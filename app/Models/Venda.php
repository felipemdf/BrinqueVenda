<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $table = 'venda';

    protected $fillable = [
        'brinquedo_id', 'quantidade_ingressos', 'cpf', 'forma_pagamento',
    ];

    public function brinquedo()
    {
        return $this->belongsTo(Brinquedo::class, 'brinquedo_id');
    }
}
