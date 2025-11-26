<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelMentoria extends Model
{
    protected $table = 'MENTORIA';
    protected $primaryKey = 'MET_INT_ID';
    public $timestamps = false;

    protected $fillable = [
        'CUR_INT_ID',
        'PLA_INT_ID',
        'MEN_INT_ID',
        'MET_STR_INSERCAO',
        'MET_INT_SITUACAO'
    ];

    public function curso()
    {
        return $this->belongsTo(ModelCurso::class, 'CUR_INT_ID', 'CUR_INT_ID');
    }

    public function plataforma()
    {
        return $this->belongsTo(ModelPlataforma::class, 'PLA_INT_ID', 'PLA_INT_ID');
    }

    public function mentor()
    {
        return $this->belongsTo(ModelMentor::class, 'MEN_INT_ID', 'MEN_INT_ID');
    }
}
