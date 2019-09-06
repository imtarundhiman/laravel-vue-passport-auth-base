<?php

namespace App\Http\Controllers\Api\V1\Notifications;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;

class NotificationController extends ApiController
{
    public function unreadNotifications(Request $request){
        $user = $request->user();

        $notifications = $user->unreadNotifications()->paginate($this->pageLimit);

        return $this->setStatusCode(200)->respondWithData($notifications->toArray(),'Notifications Fetched Successfully !');
    }

    public function unreadNotificationsCount(Request $request){
        return $this->setStatusCode(200)->respondWithData(['count' => $request->user()->unreadNotifications()->count() ]);
    }
}
