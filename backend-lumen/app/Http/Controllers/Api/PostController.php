<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Entities\Post;
use App\Http\Resources\Post\Post as PostResource;
use App\Http\Resources\Post\PostCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return  new PostCollection(Post::paginate(10));
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function getUserPosts()
    {
        return  new PostCollection(Post::where('user_id', Auth::id())->paginate());
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'text' => 'required',
            'title' => 'required',
            'image' => 'required'
        ]);
        
        $post = Post::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'text' => $request->text,
            'image' => $request->image
        ]);
        
        return new PostResource($post);
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $post = Post::find($id);

        if(!$post)
            return response()->json(['message' => 'post not found!'], 404);

        return new PostResource($post);
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
        $post = Post::find($id);

        $this->validate($request, [
            'title' => 'required',
            'text' => 'required'
        ]);

        if (Auth::user()->can('update', $post)) {

            $post->title = $request->title;
            $post->text = $request->text;
            $post->save();

            return new PostResource($post);

        } else {
            return response()->json(['error' => 'You are not allowed to update this post.'], 403);
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
        $post = Post::find($id);

        if (Auth::user()->can('delete', $post)) {

            Post::destroy($id);
            return response()->json(['message'  => 'Post has been successfully deleted.'], 200);
        } else {
            return response()->json(['message' => 'You are not allowed to delete this post.'], 403);
        }
    }
}
