<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function create(Request $request, $post_id, $user_id, $offer_id)
    {
        try {
            $notification = new Notification;

            $notification->post_id = $post_id ? $post_id : 1;
            $notification->user_id = $user_id ? $user_id : 1;
            $notification->offer_id = $offer_id ? $offer_id : 1;

            $notification->title = $request->title;
            $notification->description = $request->description;
            $notification->image = $request->image;

            $notification->save();

            return $notification;

        } catch (\Throwable $th) {
            return response($th, 500);
        }
    }
    public function offerReceived(Request $request, $post_id, $user_id, $offer_id)
    {
        try {
            $request->title = 'New offer received';
            $request->description = 'You received an offer on ' . now()->toDateTimeString();

            $notification = $this->create($request, $post_id, $user_id, $offer_id);

            return $notification;

        } catch (\Throwable $th) {
            return response($th, 500);
        }
    }
    public function offerClose($post_id, $user_id, $offer_id)
    {
        try {
            $notification = Notification::where('user_id', $user_id)
                ->where('post_id', $post_id)
                ->where('offer_id', $offer_id)
                ->get()->first();

            $notification->title = 'Offer closed';
            $notification->description = 'This offer was closed on ' . now()->toDateTimeString();

            $notification->save();

            return $notification;

        } catch (\Throwable $th) {
            return response($th, 500);
        }
    }
    public function offerComplete($post_id, $user_id, $offer_id)
    {
        try {
            $notification = Notification::where('user_id', $user_id)
                ->where('post_id', $post_id)
                ->where('offer_id', $offer_id)
                ->get()->first();

            $notification->title = 'Offer Completed';
            $notification->description = 'This offer was completed on ' . now()->toDateTimeString();

            $notification->save();

            return $notification;

        } catch (\Throwable $th) {
            return response($th, 500);
        }
    }
}
