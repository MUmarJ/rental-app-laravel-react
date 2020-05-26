<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Offer;
use App\Post;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function generate($request, $id)
    {
        try {
            $customer_id = $request->user()->id;

            // $offerExists = boolval(
            //     count(
            //         Offer::where('customer_id', $customer_id)
            //             ->where('post_id', $id)
            //             ->where('status', 'OPEN')
            //             ->get()
            //     )
            // );
            // if ($offerExists) {
            //     throw new Exception('OPEN offer already exists');
            // }

            $offer = new Offer;

            $offer->customer_id = $customer_id ? $customer_id : 1;
            $offer->post_id = $id;
            $offer->status = 'OPEN';

            $offer->save();

            return $offer;

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function create(Request $request, $id)
    {

        try {
            $offer = $this->generate($request, $id);

            $user_id = Post::findOrFail($id)->user->user_id;

            $notificationController = new NotificationController;
            $notification = $notificationController->offerReceived($request, $id, $user_id, $offer->id);

            $message = 'Error';
            $statusCode = 500;

            if ($this->isValidOffer($offer)) {
                $message = 'Success';
                $statusCode = 200;
            }

            return response(
                [
                    'message' => $message,
                    'data' =>
                    [
                        'offer' => $offer,
                        'notification' => $notification],
                ],
                $statusCode
            );
        } catch (\Throwable $th) {
            return response($th, 500);
        }
    }

    public function close(Request $request, $id)
    {
        try {
            $customer_id = $request->user()->id;
            $offer = Offer::where('customer_id', $customer_id)
                ->where('post_id', $id)
                ->where('status', 'OPEN')
                ->get()->first();

            // return $offer;

            $notificationController = new NotificationController;
            $notification = $notificationController->offerClose($id, $customer_id, $offer->id);

            $offer->status = 'CLOSED';
            $offer->save();

            if ($this->isValidOffer($offer)) {
                return response(
                    [
                        'message' => 'Offer closed',
                        'data' =>
                        [
                            'offer' => $offer,
                            'notification' => $notification],
                    ],
                    200
                );
            } else {
                return response(
                    ['message' => 'No OPEN offer exists from this user'], 500
                );
            }
        } catch (\Throwable $th) {
            return response($th, 500);
        }
    }
    public function complete(Request $request, $id)
    {
        try {
            $customer_id = $request->user()->id;
            $offer = Offer::where('customer_id', $customer_id)
                ->where('post_id', $id)
                ->where('status', 'OPEN')
                ->get()->first();

            $notificationController = new NotificationController;
            $notification = $notificationController->offerComplete($id, $customer_id, $offer->id);

            $offer->status = 'COMPLETED';
            $offer->save();

            if ($this->isValidOffer($offer)) {
                return response(
                    [
                        'message' => 'Offer completed',
                        'data' =>
                        [
                            'offer' => $offer,
                            'notification' => $notification],
                    ],
                    200
                );
            } else {
                return response(
                    ['message' => 'No OPEN offer exists from this user'], 500
                );
            }
        } catch (\Throwable $th) {
            return response($th, 500);
        }
    }

    public function isValidOffer($offer)
    {
        if (is_object($offer) && boolval(count(get_object_vars($offer)))) {
            return true;
        }
    }

    public function customer($id)
    {
        $offer = Offer::findOrFail($id);
        return response($offer->customer(), 200);
    }
}
