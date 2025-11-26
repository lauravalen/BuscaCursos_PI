<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelAreaCategoria extends Model
{
    protected $table = 'AREACATEGORIA';
    protected $primaryKey = 'ACA_INT_ID';
    public $timestamps = false;

    protected $fillable = [
        'CAT_INT_ID',
        'ACA_STR_INSERCAO',
        'ACA_INT_SITUACAO'
    ];

    // Uma área pertence a uma categoria
    public function categoria()
    {
        return $this->belongsTo(ModelCategoria::class, 'CAT_INT_ID', 'CAT_INT_ID');
    }

    // Uma área tem vários cursos
    public function cursos()
    {
        return $this->hasMany(ModelCurso::class, 'ACA_INT_ID', 'ACA_INT_ID');
    }
}
