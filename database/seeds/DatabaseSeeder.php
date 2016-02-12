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

        $users = factory(User::class, 10)->create();
        $users->each(function($user) {
            $posts = factory(Post::class, rand(3,5))->make();
            $user->posts()->saveMany($posts);
            $postIds = $posts->pluck('id')->toArray();
            $user->likes()->sync($postIds);
        });
    }
}
