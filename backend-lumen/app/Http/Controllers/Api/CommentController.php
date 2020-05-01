<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Entities\Comment;
use App\Http\Resources\Comment\Comment as CommentResource;
use App\Http\Resources\Comment\CommentCollection;
use App\Repositories\CommentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $comment;

    public function __construct(CommentRepositoryInterface $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $post_id
     * @return \Illuminate\Http\Response
    */
    public function show($post_id)
    {
        return  new CommentCollection($this->comment->getPostsComments($post_id));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  int  $post_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function store(Request $request, $post_id)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'text' => 'required'
        ]);
        
        $comment = $this->comment->save(
            new Comment(
                [
                    'user_id' => $request->user_id,
                    'post_id' => $post_id,
                    'text' => $request->text
                ]
            )
        );

        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        $this->validate($request, [
            'text' => 'required'
        ]);

        if (Auth::user()->can('update', $comment)) {

            $comment->text = $request->text;

            return new CommentResource($this->comment->save($comment));
        } else {
            return response()->json(['error' => 'You are not allowed to update this comment.'], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function delete($id)
    {
        $comment = Comment::find($id);

        if (Auth::user()->can('delete', $comment)) {

            $this->comment->delete($id);
            return response()->json(['message'  => 'Comment has been successfully deleted.'], 200);
        } else {
            return response()->json(['message' => 'You are not allowed to delete this comment.'], 403);
        }
    }

}
