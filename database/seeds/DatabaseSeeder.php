<?php

use App\User;
use App\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Post::truncate();
        DB::table('post_user')->truncate();

        // Start with X users, then iterate through each to populate other tables
        $users = factory(User::class, 50)->create();
        $users->each(function($user) {
            // Create a variable number of posts and persist them to the DB.
            // saveMany() automatically associates them with the current user_id
            $posts = factory(Post::class, rand(3,5))->make();
            $user->posts()->saveMany($posts);

            // Everything is populated now except the post_user pivot table.
            $postIds = $posts->pluck('id')->toArray();
            $user->likes()->sync($postIds);
        });
    }
}
