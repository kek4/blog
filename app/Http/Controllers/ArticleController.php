<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Picture;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('articles.index');
      //  return view('articles.index', ['articles' => Article::All()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('articles.new');
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
      'title' => 'required|unique',
      'description' => 'required',
      'inputFile' => 'required|image',
      ],
      [
      'title.required' => 'Le champ titre est requis',
      'description.required' => 'Une description est requise',
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


         $article = new Article();
         $article->name = $request->title;
         $article->description = $request->description;
         if ($request->available=='on') {
            $article->available = 1;
         }
         $article->save();

         $picture = new Picture();
         $picture->article_id = $article->id;
         $picture->title = $request->title;
         $picture->alt = $request->title;
         $picture->save();
         $path = $request->file('inputFile')->storeAs('pictures',$request->title.'.jpg');
         // $destinationPath = public_path("/uploads/");
         // $file = $request->file('inputFile');
         // $fileName = $file->getClientOriginalName();
         // $file->move($destinationPath, $fileName);



         return redirect()->route('admin.index')->with('success', $request->available);
      }
      return view('articles.new');
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
        return view('article.edit', ['article' => Article::findOrFail($id)]);
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
