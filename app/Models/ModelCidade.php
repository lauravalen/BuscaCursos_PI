<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelCidade extends Model
{
    protected $table = 'CIDADE';
    protected $primaryKey = 'CID_INT_ID';
    public $timestamps = false;

    protected $fillable = [
        'CID_STR_NOME',
        'EST_INT_ID'
    ];

    public function estado()
    {
        return $this->belongsTo(ModelEstado::class, 'EST_INT_ID', 'EST_INT_ID');
    }
}
