<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelFavorito extends Model
{
    protected $table = 'FAVORITO';
    protected $primaryKey = 'FAV_INT_ID';
    public $timestamps = false;

    protected $fillable = [
        'USU_INT_ID',
        'CUR_INT_ID',
        'FAV_STR_DATAINSERCAO',
        'FAV_INT_ATIVO'
    ];

    public function usuario()
    {
        return $this->belongsTo(ModelUsuario::class, 'USU_INT_ID', 'USU_INT_ID');
    }

    public function curso()
    {
        return $this->belongsTo(ModelCurso::class, 'CUR_INT_ID', 'CUR_INT_ID');
    }

   
}
