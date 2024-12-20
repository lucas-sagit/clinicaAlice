<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class funcionario extends Model
{
    protected $table = 'funcionario';

    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'dataNacimento',
        'senha'
    ];

    public function administrador(): BelongsTo
    {
        return $this->belongsTo(Administrador::class);
    }

    public function clientes(): HasMany {

        return $this->hasMany(Cliente::class);
    }
}
