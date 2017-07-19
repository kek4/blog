<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ListIngredient;
use App\Tag;

class Post extends Model
{

   public $fillable = ['name', 'description'];

   public function tags()
   {
      return $this->belongsToMany(Tag::class);
   }
   public function list_ingredients()
   {
      return $this->belongsToMany(ListIngredient::class);
   }
}
