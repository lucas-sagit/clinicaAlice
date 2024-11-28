<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class funcionario extends Model
{
    protected $table = 'funcionarios';

    protected $fillable = [
        'nome',
        'cpf',
        'dataNacimento'
    ];
}
