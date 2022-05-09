<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;


class NotificationController extends Controller
{
    public function read($id)
    {
        // $Notifi = DB::table('notifications')->where('id' , $id)->get();
        $Notifi = DatabaseNotification::find($id);
        // dd($Notifi);
        $Notifi->markAsRead();
        $type = $Notifi->type;
        // if($type == 'App\Notifications\MakeComment' )
        // {
        //     return redirect(route('showPost' ,$Notifi->data['data']['post_id']));
        // }
        // elseif($type == 'App\Notifications\PostRequested')
        // {
        //     return redirect(route('showRequest' ,[$Notifi->data['data']['post_id'],$Notifi->data['data']['requester_id']]));
        // }
        if($type == 'App\Notifications\MakeContact')
        {

            $other_admins_notification = DatabaseNotification::select()
            ->where('type' ,'App\Notifications\MakeContact')
            ->where('data->data->contact_id' ,$Notifi->data['data']['contact_id'])
            ->where('data->data->reporter_id' ,$Notifi->data['data']['reporter_id'])
            ->get();
            foreach($other_admins_notification as $noti)
            {
                $noti->markAsRead();
            }

            return redirect(route('admin.contact.show' ,$Notifi->data['data']['contact_id']));


        }
        elseif($type == 'App\Notifications\AdminPostReported')
        {
            $other_admins_notification = DatabaseNotification::select()
            ->where('type' ,'App\Notifications\AdminPostReported')
            ->where('data->data->post_id' ,$Notifi->data['data']['post_id'])
            ->where('data->data->reporter_id' ,$Notifi->data['data']['reporter_id'])
            ->get();
            foreach($other_admins_notification as $noti)
            {
                $noti->markAsRead();
            }

            return redirect(route('admin.report.show' ,[$Notifi->data['data']['post_id'],$Notifi->data['data']['reporter_id']]));
        }


        elseif($type == 'App\Notifications\PostAdded')
        {
            $other_admins_notification = DatabaseNotification::select()
             ->where('type' ,'App\Notifications\PostAdded')
            ->where('data->data->post_id' ,$Notifi->data['data']['post_id'])
            ->get();
            foreach($other_admins_notification as $noti)
            {
                $noti->markAsRead();
            }

            return redirect(route('admin.post.show' ,$Notifi->data['data']['post_id']));
        }
    }

    public function readAll( )
    {
        $uestUnreadNotifi = auth()->guard('admin')->user()->unreadNotifications;
        if($uestUnreadNotifi)
        {
            // dd($uestUnreadNotifi);
            $uestUnreadNotifi->markAsRead();

        }
        return back();
    }

    public function showAll()
    {
        $uestUnreadNotifi = auth()->guard('admin')->user()->unreadNotifications->sortByDesc('updated_at');
        $uestReadNotifi = auth()->guard('admin')->user()->readNotifications->sortByDesc('updated_at');
        $uestAllNotifi = auth()->guard('admin')->user()->Notifications-> sortByDesc('updated_at');

        return view('Admin.admin.notifications' , compact('uestUnreadNotifi' , 'uestReadNotifi' , 'uestAllNotifi'));
    }
}
