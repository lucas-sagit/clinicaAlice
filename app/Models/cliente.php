<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'nome',
        'cpf',
        'dataNascimento',
        'id_funcionario',
        'id_administrador'
    ];

    public function funcionario(): BelongsTo {
        return $this->belongsTo(funcionario::class);
    }

    public function administrador(): BelongsTo {
        return $this->belongsTo(administrador::class);
    }

    public function sessao(): BelongsTo {
        return $this->BelongsTo(sessao::class);
    }
}
