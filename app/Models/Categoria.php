<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = "categoria";

    protected $fillable = [
        'nom_categoria'
    ];

    public function minerals()
    {
        return $this->hasMany(Minerals::class, 'categoria_id');
    }
}
