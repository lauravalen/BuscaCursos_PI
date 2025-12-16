<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelCategoria extends Model
{

protected $table = 'CATEGORIA';
    protected $primaryKey = 'CAT_INT_ID';
    public $timestamps = false;

    protected $fillable = [
        'CAT_INT_ID',
        'CAT_STR_DESC',
        'CAT_STR_INSERCAO',
        'CAT_STR_AREA'
    ];


}
