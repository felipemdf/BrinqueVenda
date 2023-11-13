<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brinquedo extends Model
{
    use HasFactory;

    protected $table = 'brinquedo';

    protected $fillable = [
        'usuario_id', 'nome', 'descricao', 'capacidade', 'valor_ingresso', 'status_funcionamento',
    ];

    public function parque()
    {
        return $this->belongsTo(Parque::class, 'parque_id');
    }
}
