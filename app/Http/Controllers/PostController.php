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
    public function posts()
    {
       return view('posts.posts', ['posts' => Post::All()]);
    }
    /**
     * Display a single post.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function single(Post $id)
    {
       return view('posts.single', ['post' => $id]);
    }
    /**
     * Delete a post.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
       public function delete(Post $id){
         $id->list_ingredients()->detach();
        $id->delete();
        return redirect()->route('post.posts',['Post' => Post::All()])->with('success','Recette supprimée');
      }
    /**
     * Delete a post.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
        public function available(Post $id){
           $id->available = $id->available==1 ? 0 : 1;
           $id->save();
           $msg = ($id->available==0) ? "n'est maintenant plus visible" : "est maintenant visible" ;
           return redirect()->route('post.posts',['Post' => Post::All()])->with('success','Cet article '.$msg);
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
         //Create new post
         $post = new Post();
         $post->title = $request->title;
         $post->description = $request->description;
         $post->short_description = $request->short_description;
         if ($request->available=='on') {
            $post->available = 1;
         }
         $post->save();
         //Create new picture
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

         // Create or insert list of ingredient and ingredient
         $recipeListIng = json_decode($request->recipeListIngHidden);
         if (!is_null($recipeListIng)) {
            foreach ($recipeListIng as $listIng) {
               self::insert_list_ingredient($listIng, $post->id);
            }
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
      public static function insert_list_ingredient($listIngredient, $idPost)
      {
         $test = ListIngredient::where('title', $listIngredient->title)->exists();
         $newList = ListIngredient::firstOrCreate(['title' => $listIngredient->title]);
         if (!$test) {
            foreach ($listIngredient->ingredients as $ingredient) {
               self::insert_ingredient($ingredient, $newList->id);
            }
         }
         $newList->posts()->attach($idPost);
      }

      /**
      *Check if an ingredient exist, if not insert in bdd
      *
      * @param  string $ingredient
      * @return
      */
      public static function insert_ingredient($ingredient, $idList)
      {
          $newIngredient = Ingredient::firstOrCreate(['name' => $ingredient->name, 'unite' => $ingredient->unite]);
          $newIngredient->list_ingredients()->attach($idList, array('quantity' => $ingredient->quantity));
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
