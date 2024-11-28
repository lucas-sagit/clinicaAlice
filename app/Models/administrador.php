<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class administrador extends Model
{
    protected $table = 'administradors';

    protected $fillable = [
        'nome',
        'cpf',
        'dataNascimeto'
    ];

}
