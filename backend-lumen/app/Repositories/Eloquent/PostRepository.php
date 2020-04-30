<?php

namespace App\Repositories\Eloquent;

use App\Repositories\PostRepositoryInterface;
use App\Entities\Post;

class PostRepository implements PostRepositoryInterface
{
    const LIMIT = 10;

    public function getPosts()
    {
        return Post::paginate(self::LIMIT);
    }

    public function getPostByUserId(int $userId)
    {
        return Post::where('user_id',$userId)->paginate();
    }

    public function getPost(int $id): Post
    {
        return Post::find($id);
    }

    public function save(Post $post): Post
    {
        $post->save();
        return $post;
    }

    public function delete(int $id): void
    {
        Post::destroy($id);
    }
}