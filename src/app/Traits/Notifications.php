<?php
use App\Notifications\PostChange as Notification;
use Illuminate\Http\Request;

trait customNotifications
{
    public function create(Request $request)
    {
        $notification = new Notification;
        $notification->user_id = $request->user_id;
        $notification->post_id = $request->post_id;
        $notification->title = $request->title;
        $notification->description = $request->description;
        $notification->image = $request->image;
        $notification->save();

        return $notification;
    }
}
