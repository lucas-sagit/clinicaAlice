<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class valor extends Model
{
    protected $table = 'valores';

    protected $fillalbe = [
        'valorRecebido'
    ];

    public function administrador(): BelongsTo{

        return $this->belongsTo(administrador::class);
    }
}
