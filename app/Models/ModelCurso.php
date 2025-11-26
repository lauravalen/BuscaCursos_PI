<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelCurso extends Model
{
    protected $table = 'CURSO';
    protected $primaryKey = 'CUR_INT_ID';
    public $timestamps = false;

    protected $fillable = [
        'ACA_INT_ID',
        'CUR_STR_TITULO',
        'CUR_STR_URL',
        'CUR_STR_CERTIFICACAO',
        'CUR_FLO_QUANTHORA',
        'CUR_STR_DESC',
        'CUR_STR_DATAINICIO',
        'CUR_STR_NIVELENSINO',
        'CUR_STR_INSERCAO'
    ];

    // Curso pertence a uma área
    public function areaCategoria()
    {
        return $this->belongsTo(ModelAreaCategoria::class, 'ACA_INT_ID', 'ACA_INT_ID');
    }

    public function comentarios()
    {
    return $this->hasMany(ModelComentario::class, 'CUR_INT_ID');
    }

    public function plataformas()
    {
    return $this->belongsToMany(ModelPlataforma::class, 'PLATAFORMACURSO', 'CUR_INT_ID', 'PLA_INT_ID')
        ->withPivot(['PLC_STR_DATAINSERCAO', 'PLC_INT_SITUACAO']);
    }

    // Curso tem várias mentorias
    public function mentorias()
    {
        return $this->hasMany(ModelMentoria::class, 'CUR_INT_ID', 'CUR_INT_ID');
    }

    // Curso pode estar nos favoritos de vários usuários
    public function favoritos()
    {
        return $this->hasMany(ModelFavorito::class, 'CUR_INT_ID', 'CUR_INT_ID');
    }

    // Curso pode aparecer no histórico de vários usuários
    public function historicos()
    {
        return $this->hasMany(ModelHistorico::class, 'CUR_INT_ID', 'CUR_INT_ID');
    }
}
