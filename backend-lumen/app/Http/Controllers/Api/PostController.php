<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Entities\Post;
use App\Http\Resources\Post\Post as PostResource;
use App\Http\Resources\Post\PostCollection;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private $post;

    public function __construct(PostRepositoryInterface $post)
    {
        $this->post = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return  new PostCollection($this->post->getPosts());
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function getUserPosts()
    {
        return  new PostCollection($this->post->getPostByUserId(Auth::id()));
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
        
        $post = $this->post->save(
            new Post(
                [
                    'user_id' => $request->user_id,
                    'title' => $request->title,
                    'text' => $request->text,
                    'image' => $request->image
                ]
            )
        );
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

        return new PostResource($this->post->getPost($id));
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
            'text' => 'required',
            'image' => 'required'
        ]);

        if (Auth::user()->can('update', $post)) {

            $post->title = $request->title;
            $post->text = $request->text;
            $post->image = $request->image;

            return new PostResource($this->post->save($post));
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

            $this->post->delete($id);
            return response()->json(['message'  => 'Post has been successfully deleted.'], 200);
        } else {
            return response()->json(['message' => 'You are not allowed to delete this post.'], 403);
        }
    }
}
