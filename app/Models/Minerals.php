<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Minerals extends Model
{
    protected $table = "minerals";

    protected $fillable = [
        'nom',
        'descripcio',
        'preu',
        'foto',
        'categoria_id',
    ];

    public function comandes()
    {
        return $this->hasMany(Comanda::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}

