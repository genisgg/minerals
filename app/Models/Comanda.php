<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comanda extends Model
{
    protected $table = "comanda";

    protected $fillable = [
        'usuari_id',
        'data_comanda',
        'estat',
    ];

    public function usuaris()
    {
        return $this->belongsTo(User::class);
    }

    public function minerals()
    {
        return $this->hasMany(Minerals::class);
    }
}
