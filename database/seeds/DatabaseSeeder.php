<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Post;
use Illuminate\Support\Facades\DB;
use Faker\Generator;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);
        User::truncate();
        Post::truncate();
        // DB::table('post_user')->truncate();

        factory(User::class, 50)
            ->create()
            ->each(function($user) {
                $postIds = factory(App\Post::class, 50)->create()->pluck('id')->toArray();
                $user->likes()->sync($postIds);
            });
        factory(Post::class, 50)->create();
    }
}
