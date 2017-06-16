<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
   public function list_ingredients()
   {
      return $this->belongsToMany(ListIngredient::class);
   }
}
