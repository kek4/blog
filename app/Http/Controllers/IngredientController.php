<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Ingredient;
use Validator;

class IngredientController extends Controller
{

   public function listJson(){
      $list = Ingredient::all();
      return $list->toJson();
   }

   // public function store(Request $request){
   //    $validator = Validator::make($request->all(), [
   //       'ingredient' => 'required|regex:/[a-z\-\ ]{3,}/i|unique:ingredient',
   //    ],
   //    [
   //       'required' => 'Le champ :attribute est requis',
   //    ]);
   //    if ($validator->fails() && $request->isMethod('post')) {
   //       return $validator->fails();
   //    }elseif ($request->isMethod('post')) {
   //       $ingredient = new Ingredient();
   //       $ingredient->title = $request->ingredient;
   //       $ingredient->save();
   //       // a voir faire un return avec un succes
   //    }
   }

}
