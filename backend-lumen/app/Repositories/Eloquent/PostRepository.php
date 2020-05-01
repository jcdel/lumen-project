<?php

namespace App\Repositories\Eloquent;

use App\Repositories\PostRepositoryInterface;
use App\Entities\Post;

class PostRepository implements PostRepositoryInterface
{
    const POST_LIMIT = 8;
    const USER_POST_LIMIT = 3;

    public function getPosts()
    {
        return Post::paginate(self::POST_LIMIT);
    }

    public function getPostByUserId(int $userId)
    {
        return Post::where('user_id',$userId)->paginate(self::USER_POST_LIMIT);
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