<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelPlataformaCurso extends Model
{
    protected $table = 'PLATAFORMACURSO';
    protected $primaryKey = 'PLC_INT_ID';
    public $timestamps = false;

    protected $fillable = [
        'CUR_INT_ID',
        'PLA_INT_ID',
        'PLC_STR_DATAINSERCAO',
        'PLC_INT_SITUACAO'
    ];

    public function curso()
    {
        return $this->belongsTo(ModelCurso::class, 'CUR_INT_ID');
    }

    public function plataforma()
    {
        return $this->belongsTo(ModelPlataforma::class, 'PLA_INT_ID');
    }
}
