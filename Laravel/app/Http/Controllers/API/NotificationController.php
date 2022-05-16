<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\NotificationCollection;
use App\Http\Resources\NotificationResource;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NotificationController extends BaseController
{



    public function GET()
    {
        $notifications = Auth::user()->unreadNotifications;
        // dd($notifications);
        $data = $notifications;
        $js = new NotificationCollection($data);
        return $this->SendResponse($js, "ALL Unreaded Notifications sent");
    }



    public function GetAll()
    {
        $notifications = Auth::user()->Notifications;
        // dd($notifications);
        $data = $notifications;
        $js = new NotificationCollection($data);
        return $this->SendResponse($js, "ALL Notifications sent");
    }



    public function read($id)
    {



        $Notifi = DatabaseNotification::find($id);
        if($Notifi->notifiable_id != Auth::id())
        {
            return $this->SendError('You Are Not Allowed To Read This Notifiaction');
        }
        $Notifi->markAsRead();
        return $this->SendResponse(new NotificationResource($Notifi) , 'Notification Read Successfully');
        // $type = $Notifi->type;
        // if ($type == 'App\Notifications\MakeComment') {
        //     return redirect(route('showPost', $Notifi->data['data']['post_id']));
        // } elseif ($type == 'App\Notifications\PostRequested') {
        //     return redirect(route('showRequest', [$Notifi->data['data']['post_id'], $Notifi->data['data']['requester_id']]));
        // }
        // elseif ($type == 'App\Notifications\RequestCanceled') {
        //     return redirect(route('show.pending'));
        // }
    }

    public function readAll()
    {
        $uestUnreadNotifi = Auth::user()->unreadNotifications;
        if ($uestUnreadNotifi) {
            // dd($uestUnreadNotifi);
            $uestUnreadNotifi->markAsRead();
        }
        return $this->SendResponse('Done' , "All Notifications Marked as READ");
    }
}
