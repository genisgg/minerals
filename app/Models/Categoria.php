<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = "categoria";

    protected $fillable = [
        'nom_categoria',
        'nom_categoria_en',
        'nom_categoria_es',
        'nom_categoria_fr',
    ];

    public function minerals()
    {
        return $this->hasMany(Minerals::class, 'categoria_id');
    }
}
