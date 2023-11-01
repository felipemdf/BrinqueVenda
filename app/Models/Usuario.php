<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuario';
    protected $fillable = [
        'nome', 'email', 'senha',
    ];

    public function parques(){
        return $this->hasMany('App\Models\Parque');
    }
}
