<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Minerals extends Model
{
    //
    protected $table="minerals";

    public function comanda()
    {
        return $this->hasMany(Comanda::class);
    }
    
    public function categoria()
   {
       return $this->belongsTo(Categoria::class);
   }

}
