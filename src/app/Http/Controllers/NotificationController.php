<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Notifications;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(Request $request)
    {
        try {
            $notification = new Notifications\PostChange;

            $notification->user_id = $request->user_id ? $request->user_id : 1;
            $notification->post_id = $request->post_id ? $request->post_id : 1;
            $notification->title = $request->title;
            $notification->description = $request->description;
            $notification->image = $request->image;

            $notification->save();

            return response('Success', 200);

        } catch (\Throwable $th) {
            return response($th, 500);
        }
    }

    // If category checking is needed*
    public function category($id)
    {
        $post = Post::findOrFail($id);
        return response($post->category->name, 200);
        // return response($post);
    }

    public function deactivate($id)
    {
        return new PostResource(
            Post::findOrFail($id)
                ->update(['post_status' => 'INACTIVE'])
        );
    }
}
