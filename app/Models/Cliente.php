<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'identificacao',
        'data_de_nascimento',
        'classificacao',
        'tipo_alimentacao',
        'observacoes'
    ];
}
