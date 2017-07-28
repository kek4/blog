<?php

namespace Tests\Feature;

use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TaggableTest extends TestCase
{

   public function setUp()
   {
      parent::setUp();
      Artisan::call('migrate');
   }
   /**
     * A basic test example.
     *
     * @return void
     */

     public function testCreateTags()
     {
        $post = factory(Post::class)->create();
        $post->saveTags('sucré,salé,framboise,salé');
        $this->assertEquals(3, Tag::count());
        $this->assertEquals(1, Tag::first()->post_count);
        $this->assertEquals(3, DB::table('post_tag')->count());
     }

     public function testEmptyTags()
     {
       $post = factory(Post::class)->create();
       $post->saveTags('');
       $this->assertEquals(0, Tag::count());
     }

     public function testReuseTags()
     {
        $posts = factory(Post::class, 2)->create();
        $post1 = $posts->first();
        $post2 = $posts->last();
        $post1->saveTags('sucré ,salé,framboise,,');
        $post2->saveTags('sucré,citron');
        $this->assertEquals(4, Tag::count());
        $this->assertEquals(5, DB::table('post_tag')->count());
        $this->assertEquals(3, DB::table('post_tag')->where('post_id', $post1->id)->count());
        $this->assertEquals(2, DB::table('post_tag')->where('post_id', $post2->id)->count());
        $this->assertEquals(2, Tag::where('name', 'sucré')->first()->post_count);
     }

     public function testPostCountOnTags()
     {
        $posts = factory(Post::class, 2)->create();
        $post1 = $posts->first();
        $post2 = $posts->last();
        $post1->saveTags('sucré,salé,framboise');
        $post2->saveTags('sucré');
        $this->assertEquals(2, Tag::where('name', 'sucré')->first()->post_count);
        $post2->saveTags('salé');
        $this->assertEquals(1, Tag::where('name', 'sucré')->first()->post_count);
        $this->assertEquals(2, Tag::where('name', 'salé')->first()->post_count);
     }

     public function testCleanUnusedTags () {
             $post = factory(Post::class)->create();
             $post->saveTags('salut,chien,chat');
             $this->assertEquals(3, Tag::count());
             $post->saveTags('');
             $this->assertEquals(0, Tag::count());
         }
}
