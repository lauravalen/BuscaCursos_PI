<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelComentario extends Model
{
    protected $table = 'COMENTARIO';
    protected $primaryKey = 'COM_INT_ID';
    public $timestamps = false;

    protected $fillable = [
        'USU_INT_ID',
        'CUR_INT_ID',
        'COM_STR_COMENTARIO',
        'COM_INT_AVALIACAO',
        'COM_STR_DATAPUBLICACAO',
        'COM_INT_SITUACAO'
    ];

    public function usuario()
    {
        return $this->belongsTo(ModelUsuario::class, 'USU_INT_ID');
    }

    public function curso()
    {
        return $this->belongsTo(ModelCurso::class, 'CUR_INT_ID');
    }
}
