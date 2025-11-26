<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelLogCurso extends Model
{
    protected $table = 'LOG_CURSO';
    protected $primaryKey = 'LOG_INT_ID';
    public $timestamps = false;

    protected $fillable = [
        'CUR_INT_ID',
        'LOG_STR_ACAO',
        'LOG_STR_INFO',
        'LOG_STR_DATA',
    ];

    // Como o campo é JSON, tratamos automaticamente como array
    protected $casts = [
        'LOG_STR_INFO' => 'array',
        'LOG_STR_DATA' => 'datetime',
    ];

    // Relação com o curso (se você já tem ModelCurso)
    public function curso()
    {
        return $this->belongsTo(ModelCurso::class, 'CUR_INT_ID', 'CUR_INT_ID');
    }
}
