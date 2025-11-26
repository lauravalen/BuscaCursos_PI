<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelEstado extends Model
{
    protected $table = 'ESTADO';
    protected $primaryKey = 'EST_INT_ID';
    public $timestamps = false;

    protected $fillable = [
        'EST_STR_NOME',
        'EST_STR_UF'
    ];
}
