<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\NotificationCollection;
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
        // $Notifi = DB::table('notifications')->where('id' , $id)->get();
        $Notifi = DatabaseNotification::find($id);
        // dd($Notifi);
        $Notifi->markAsRead();
        $type = $Notifi->type;
        if ($type == 'App\Notifications\MakeComment') {
            return redirect(route('showPost', $Notifi->data['data']['post_id']));
        } elseif ($type == 'App\Notifications\PostRequested') {
            return redirect(route('showRequest', [$Notifi->data['data']['post_id'], $Notifi->data['data']['requester_id']]));
        }
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
