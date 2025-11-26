<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelGenero extends Model
{
    protected $table = 'GENERO';
    protected $primaryKey = 'GEN_INT_ID';
    public $timestamps = false;

    protected $fillable = [
        'GEN_STR_DESC'
    ];
}
