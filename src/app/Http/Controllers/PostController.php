<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\PostCollection as PostCollection;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * API Controller for Posts.
     *
     * @param  int  $id
     * @param? Request $request
     */
    public function index()
    {
        return new PostCollection(Post::all());
    }
    public function show($id)
    {
        return new PostResource(Post::findOrFail($id));
    }
    public function create(Request $request)
    {
        // Validate the request...
        try {
            $post = new Post;

            $post->user_id = $request->user_id ? $request->user_id : 1;
            $post->category_id = $request->category_id ? $request->category_id : 1;
            $post->title = $request->title;
            $post->description = $request->description;
            $post->offer_start = $request->offer_start;
            $post->offer_end = $request->offer_end;
            $post->post_status = $request->post_status;
            $post->post_status = 'ACTIVE';

            $post->save();

            return response('Success', 200);

        } catch (\Throwable $th) {
            return response($th, 500);
        }

    }
    public function edit($id, Request $request)
    {
        try {
            $post = Post::find($id);

            $post->category_id = $request->category_id ? $request->category_id : 1;
            $post->title = $request->title;
            $post->description = $request->description;
            $post->offer_start = $request->offer_start;
            $post->offer_end = $request->offer_end;
            $post->post_status = $request->post_status;

            $post->save();

            return response('Success', 200);
        } catch (\Throwable $th) {
            return response($th, 500);
        }
    }
    public function poster($id)
    {
        $post = Post::findOrFail($id);
        return response($post->user->name, 200);
    }

    public function deactivate($id)
    {
        return new PostResource(
            Post::findOrFail($id)
                ->update(['post_status' => 'INACTIVE'])
        );
    }
}
