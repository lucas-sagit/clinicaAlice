<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class sessao extends Model
{
    protected $table = 'sessoes';

    protected $fillable = [
        'quantidadePaga',
        'quantidadeFalta',
        'id_cliente'
    ];

    public function clientes(): HasMany {

        return $this->hasMany(Cliente::class);
    }
}
