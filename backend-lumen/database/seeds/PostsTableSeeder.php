<?php

use Illuminate\Database\Seeder;
use App\Entities\Post;
use App\Entities\User;
use App\Entities\Comment;

class PostsTableSeeder extends Seeder
{

    public function run()
    {
        foreach (User::all() as $user) {
            $user->posts()->saveMany(factory(Post::class,10)->make(['user_id' => $user->id]))->each(function ($post) use ($user) {
                $post->comments()->saveMany(factory(Comment::class, 1)->make(['user_id' => $user->id]));
            });
        };
    }
}