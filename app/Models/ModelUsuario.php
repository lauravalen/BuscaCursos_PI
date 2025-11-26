<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelUsuario extends Model
{
  
    // Nome da tabela
    protected $table = 'usuario';

    // Nome da chave primária
    protected $primaryKey = 'USU_INT_ID';

    // Desativar timestamps automáticos (created_at, updated_at)
    public $timestamps = false;

    // Campos que podem ser preenchidos em massa (mass assignment)
    protected $fillable = [
        'USU_STR_NOMEE',
        'USU_STR_EMAIL',
        'USU_STR_SENHA',
        'USU_STR_INSERCAO',
        'USU_INT_SITUACAO'
    ];

     public function favoritos(){
        return $this->hasMany(ModelFavorito::class, 'USU_INT_ID');
    }
}

   