<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parque extends Model
{
    use HasFactory;

    protected $table = 'parque';
    
    protected $fillable = [
        'usuario_id', 'nome',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
