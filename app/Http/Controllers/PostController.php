<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Picture;
use App\ListIngredient;
use App\Ingredient;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('posts.index');
      //  return view('articles.index', ['articles' => Article::All()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('posts.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
      'title' => 'required|unique:posts',
      'description' => 'required',
      'short_description' => 'required',
      'inputFile' => 'required|image',
      ],
      [
      'title.required' => 'Le champ titre est requis',
      'description.required' => 'Une description est requise',
      'short_description.required' => 'Une description courte est requise',
      ]);
      if ($validator->fails() && $request->isMethod('post')) {
        return redirect()->route('admin.create')->withErrors($validator)->withInput();
         }elseif ($request->isMethod('post')) {
      //   toaster
      //   if ($request->gender) {
      //     $successMsg = 'Nouvel auteur enregistré';
      //   }else{
      //     $successMsg = 'Nouvelle auteur enregistrée';
      //   }


         $post = new Post();
         $post->title = $request->title;
         $post->description = $request->description;
         $post->short_description = $request->short_description;
         if ($request->available=='on') {
            $post->available = 1;
         }
         $post->save();

         $picture = new Picture();
         $picture->post_id = $post->id;
         $picture->title = $request->title;
         $picture->alt = $request->title;
         $picture->save();
         $path = $request->file('inputFile')->storeAs('pictures',$request->title.'.jpg');
         // $destinationPath = public_path("/uploads/");
         // $file = $request->file('inputFile');
         // $fileName = $file->getClientOriginalName();
         // $file->move($destinationPath, $fileName);


         $recipeListIng = json_decode($request->recipeListIngHidden);
         foreach ($recipeListIng as $listIng) {
            if ($listIng->new == 1) {
               # code...
            }
            //$listIngredient = new ListIngredient();
            //le titre
            //$value->title;
            // foreach ($value->ingredient as $key => $value) {
            //tableau d'ingrédient : on ajoute si existe pas sinon on prend l'id et on ajoute dans table pivot
               // $ingredient = new Ingredient();
            // }
         }



         return redirect()->route('admin.create')->with('success', 'La recette :'.$request->title.' a été créee');
         }
      return view('posts.new');
      }

      /**
      *Check if list of ingredient exist, if not insert in bdd then associate with the current post
      *
      * @param  string $listIngredient
      * @return
      */
      public function insert_list_ingredient($listIngredient)
      {
          if ($listIngredient->new == 1) {
             $newList = new ListIngredient();
             $newList->title = $listIngredient->title;
             $newList->save();
          }
      }

      /**
      *Check if an ingredient exist, if not insert in bdd
      *
      * @param  string $ingredient
      * @return
      */
      public function insert_ingredient($ingredient)
      {
          if ($listIngredient->new == 1) {
             $newList = new ListIngredient();
             $newList->title = $listIngredient->title;
             $newList->save();
          }
      }

      // $article = new Article();
      // $post->title = $request->get('title');
      // $post->body = $request->get('body');
      // $post->slug = str_slug($post->title);
      //
      // $duplicate = Posts::where('slug',$post->slug)->first();
      // if($duplicate)
      // {
      //    return redirect('new-post')->withErrors('Title already exists.')->withInput();
      // }
      //
      // $post->author_id = $request->user()->id;
      // if($request->has('save'))
      // {
      //    $post->active = 0;
      //    $message = 'Post saved successfully';
      // }
      // else
      // {
      //    $post->active = 1;
      //    $message = 'Post published successfully';
      // }
      // $post->save();
      // return redirect('edit/'.$post->slug)->withMessage($message);
   //  }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('post.edit', ['post' => Post::findOrFail($id)]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
