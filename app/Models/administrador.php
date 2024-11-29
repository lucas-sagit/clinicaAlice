<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class administrador extends Model
{
    protected $table = 'administradors';

    protected $fillable = [
        'nome',
        'cpf',
        'dataNascimeto',
        'senha'
    ];

    public function funcionarios(): HasMany
    {
        return $this->hasMany(Funcionario::class);
    }

    public function clientes(): HasMany {

        return $this->hasMany(Cliente::class);
    }

    public function valor(): HasMany {

        return $this->hasMany(valor::class);
    }

}
