<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class ModelAdministrador extends Model
{

    
    // Nome da tabela
    protected $table = 'ADMINISTRADOR';

    // Nome da chave primária
    protected $primaryKey = 'ADM_INT_ID';

    // Desativar timestamps automáticos (created_at, updated_at)
    public $timestamps = false;

    // Campos que podem ser preenchidos em massa (mass assignment)
    protected $fillable = [
        'ADM_STR_NOME',
        'ADM_STR_CPF',
        'ADM_STR_SENHA',
        'ADM_STR_DATAINSERCAO',
        'ADM_INT_SITUACAO',
        'ADM_STR_EMAIL'
    ];

     // ENCRIPTAR AUTOMATICAMENTE AO SALVAR
    public function setADMSTRCPFAttribute($value)
    {
        $this->attributes['ADM_STR_CPF'] = Crypt::encryptString($value);
    }

    public function getADMSTRCPFAttribute($value)
    {
        return Crypt::decryptString($value);
    }
}
