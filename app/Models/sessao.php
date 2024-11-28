<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sessao extends Model
{
    protected $table = 'sessoes';

    protected $fillable = [
        'quantidadePaga',
        'quantidadeFalta'
    ];
}
