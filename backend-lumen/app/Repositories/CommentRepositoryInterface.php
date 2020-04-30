<?php

namespace App\Repositories;

use App\Entities\Comment;

interface CommentRepositoryInterface
{
    public function getPostsComments(int $post_id);
    public function saveComment(Comment $comment);
}