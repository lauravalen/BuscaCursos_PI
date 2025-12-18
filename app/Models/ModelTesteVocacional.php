<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelTesteVocacional extends Model
{
    protected $table = 'TESTE_VOCACIONAL';
    protected $primaryKey = 'TES_INT_ID';
    public $timestamps = false;

    protected $fillable = [
        'USU_INT_ID',
        'CAT_INT_ID',
        'TES_INT_PONTUACAO',
        'TES_STR_DATA',
        'TES_INT_SITUACAO'
    ];

    // Relacionamento com o usuário
    public function usuario()
    {
        return $this->belongsTo(ModelUsuario::class, 'USU_INT_ID', 'USU_INT_ID');
    }

    // Relacionamento com categoria
    public function categoria()
    {
        return $this->belongsTo(ModelCategoria::class, 'CAT_INT_ID', 'CAT_INT_ID');
    }
}
