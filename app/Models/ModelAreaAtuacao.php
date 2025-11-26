<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelAreaAtuacao extends Model
{
    protected $table = 'AREA_ATUACAO';
    protected $primaryKey = 'AAT_INT_ID';
    public $timestamps = false;

    protected $fillable = [
        'AAT_STR_DESC'
    ];
}
