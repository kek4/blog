<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use App\ListIngredient;
use App\Tag;

class Post extends Model
{

   public $fillable = ['title', 'description'];

   public function tags()
   {
      return $this->belongsToMany(Tag::class);
   }
   public function list_ingredients()
   {
      return $this->belongsToMany(ListIngredient::class);
   }


   public function saveTags($tags)
   {
      $tags = array_filter(array_unique(array_map(function ($item) {
         return trim($item);
      },explode(',', $tags))), function($item) {
         return !empty($item);
      });

      //find tags already exist
      $tagsSync = Tag::whereIn('name', $tags)->get();

      //fill array with tags to create
      $tags_create = array_diff($tags, $tagsSync->pluck('name')->all());
      $tags_create = array_map(function($tag)   {
         return['name' => $tag];
      }, $tags_create);

      $created_tags = $this->tags()->createMany($tags_create);
      // merge tags created and already exist the sync in pivot table
      $tagsSync = $tagsSync->merge($created_tags);

      $edits = $this->tags()->sync($tagsSync);
      Tag::whereIn('id', $edits['attached'])->increment('post_count', 1);
      Tag::whereIn('id', $edits['detached'])->decrement('post_count', 1);
      Tag::where('post_count', 0)->delete();
   }



}
