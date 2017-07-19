<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ListIngredient;

class Ingredient extends Model
{
   public $timestamps = false;
   protected $hidden = ['pivot'];
   protected $fillable = ['name'];
   public function list_ingredients()
   {
      return $this->belongsToMany(ListIngredient::class);
   }
}
