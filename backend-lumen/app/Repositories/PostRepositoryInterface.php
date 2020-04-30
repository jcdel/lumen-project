<?php

namespace App\Repositories;

use App\Entities\Post;

interface PostRepositoryInterface
{
    public function getPosts();
    public function getPostByUserId(int $userId);
    public function getPost(int $id);
    public function save(Post $post);
    public function delete(int $id);
}