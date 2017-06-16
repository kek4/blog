<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Ingredient;
use App\ListIngredient;
use Validator;

class ListIngController extends Controller
{

   public function listJson(){
      $list = ListIngredient::all();
      return $list->toJson();
   }

   public function store(Request $request)
   {

     }
}
