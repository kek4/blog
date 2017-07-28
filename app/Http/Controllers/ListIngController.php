<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Ingredient;
use App\ListIngredient;
use Validator;

class ListIngController extends Controller
{
   public $title;
   public $model;
   public $new;
   public $ingredients;

   public function __construct($title = '', $model = null, $new = 0, $ingredients = []) {
     $this->title = $title;
     $this->model = $model;
     $this->new = $new;
     $this->ingredients = $ingredients;
   }

   public function index()
   {
      return view('list_ing.list_ing', ['listIngs' => self::listJson()]);
     }

   public function listJson(){
      $lists = ListIngredient::all();
      $lists_complete = collect();
      foreach ($lists as $list) {
         $ingredients = $list->ingredients()->get(['name','quantity'])->toArray();
         $tmp_list = new self($list->title);
         $tmp_list->ingredients = $ingredients;
         $lists_complete->push($tmp_list);
      }
      return $lists_complete;
   }

   public function store(Request $request)
   {

     }
}
