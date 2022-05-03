<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refeicao extends Model
{
    use HasFactory;
    protected $table = "refeicoes";
    protected $fillable = [
        'cliente_id',
        'data',
        'cafe',
        'almoco',
        'janta',
        'classificacao',
        'tipo_alimentacao'
    ];
}
