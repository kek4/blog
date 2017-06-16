<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListIngredient extends Model
{

   protected $appends = ['model', 'new'];

   function getModelAttribute() {
     return $this->model = null;
   }

   function getNewAttribute() {
     return $this->new = 1;
   }

   public function ingredients()
   {
      return $this->belongsToMany(Ingredient::class)->withPivot('quantity');
   }
}
