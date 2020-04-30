<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CommentRepositoryInterface;
use App\Entities\Comment;


class CommentRepository implements CommentRepositoryInterface
{
     public function getPostsComments(int $post_id)
     {
         return Comment::where('post_id',$post_id)->get();
     }

     public function save(Comment $comment): Comment
     {
         $comment->save();

         return $comment;
     }
}