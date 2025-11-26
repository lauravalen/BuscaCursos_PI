<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelHistorico extends Model
{
    protected $table = 'HISTORICOUSUARIO';
    protected $primaryKey = 'HIS_INT_ID';
    public $timestamps = false;

    protected $fillable = [
        'HIS_STR_INSERCAO',
        'HIS_STR_DESCRICAO',
        'PLC_INT_ID',
        'USU_INT_ID',
        'CUR_INT_ID',
        'ACA_INT_ID'
    ];

    public function usuario()
    {
        return $this->belongsTo(ModelUsuario::class, 'USU_INT_ID', 'USU_INT_ID');
    }

    public function curso()
    {
        return $this->belongsTo(ModelCurso::class, 'CUR_INT_ID', 'CUR_INT_ID');
    }

    public function areaCategoria()
    {
        return $this->belongsTo(ModelAreaCategoria::class, 'ACA_INT_ID', 'ACA_INT_ID');
    }

    public function plataformaCurso()
    {
        return $this->belongsTo(ModelPlataforma::class, 'PLC_INT_ID', 'PLC_INT_ID');
    }
}
