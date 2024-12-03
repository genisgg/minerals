<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //
   protected $table="categoria";

   public function minerals()
   {
       return $this->belongsTo(Minerals::class);
   }
}
