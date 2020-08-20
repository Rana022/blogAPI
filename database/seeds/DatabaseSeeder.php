<?php

use App\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        factory(App\User::class, 3)->create();
        factory(App\Tag::class, 3)->create();
        factory(App\Category::class, 3)->create();
        factory(App\Post::class, 24)->create();
        $posts = Post::all();
        App\Category::all()->each(function ($category) use ($posts){
               $category->posts()->attach(
                 $posts->random(3)->pluck('id')->toArray()
               );
        });

        App\Tag::all()->each(function ($tag) use ($posts){
            $tag->posts()->attach(
              $posts->random(3)->pluck('id')->toArray()
            );
     });
     factory(App\Comment::class, 20)->create();  
    }
}







