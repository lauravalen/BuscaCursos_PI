<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelPlataforma extends Model
{
    protected $table = 'PLATAFORMA';
    protected $primaryKey = 'PLA_INT_ID';
    public $timestamps = false;

    protected $fillable = [
        'ADM_INT_ID',
        'PLA_STR_NOME',
        'PLA_STR_URL',
        'PLA_STR_DESC',
        'PLA_INT_QUANTCURSO'
    ];

    public function cursos()
    {
        return $this->belongsToMany(
            ModelCurso::class,
            'PLATAFORMACURSO',
            'PLA_INT_ID',
            'CUR_INT_ID'
        )->withPivot(['PLC_STR_DATAINSERCAO', 'PLC_INT_SITUACAO']);
    }
}
