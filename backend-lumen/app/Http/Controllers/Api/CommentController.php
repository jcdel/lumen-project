<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Entities\Comment;
use App\Http\Resources\Comment\Comment as CommentResource;
use App\Http\Resources\Comment\CommentCollection;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $post_id
     * @return \Illuminate\Http\Response
    */
    public function show($post_id)
    {
        return  new CommentCollection(Comment::where('post_id',$post_id)->get());
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
        
        $comment = Comment::create([
            'user_id' => $request->user_id,
            'post_id' => $post_id,
            'text' => $request->text,
        ]);
        
        return new CommentResource($comment);

    }

}
