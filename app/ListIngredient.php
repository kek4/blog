<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\Ingredient;

class ListIngredient extends Model
{
   public $timestamps = false;
   protected $appends = ['model', 'new'];
   protected $hidden = ['pivot'];
   protected $fillable = ['title'];

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

   public function posts()
   {
      return $this->belongsToMany(Post::class);
   }
}
