<?php

namespace App\Repositories;

use App\Entities\Comment;

interface CommentRepositoryInterface
{
    public function getPostsComments(int $post_id);
    public function save(Comment $comment);
    public function delete(int $id);
}