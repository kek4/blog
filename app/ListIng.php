<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListIng extends Model
{
   public function ingredients()
   {
      return $this->belongsToMany(Ingredient::class)->withPivot('quantity');
   }
}
