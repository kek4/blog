<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('article.index', ['articles' => Article::All()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('article.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $article = new Article();
      $post->title = $request->get('title');
      $post->body = $request->get('body');
      $post->slug = str_slug($post->title);

      $duplicate = Posts::where('slug',$post->slug)->first();
      if($duplicate)
      {
         return redirect('new-post')->withErrors('Title already exists.')->withInput();
      }

      $post->author_id = $request->user()->id;
      if($request->has('save'))
      {
         $post->active = 0;
         $message = 'Post saved successfully';
      }
      else
      {
         $post->active = 1;
         $message = 'Post published successfully';
      }
      $post->save();
      return redirect('edit/'.$post->slug)->withMessage($message);
    }

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
