<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;

class BanController extends Controller
{

    public function index($user_id)
    {
        $user = User::find($user_id);
        return view('Admin.user.ban.index' , compact('user'));
    }

    public function ban(Request $request)
    {
        $request->validate(['time'=> 'required|integer|min:0|max:100'] , ['time.required' => 'You Must Enter Duration Of Ban']);
        $user_id = $request->user_id;
        $n = $request->time;
        $user = User::find($user_id);

        if ($n == 0) {
            $ban_permanently = 0;
            $user->banned_till = $ban_permanently;
            $user->save();
        } else {
            $ban_for_next_n_days = Carbon::now()->addDays($n);
            $user->banned_till = $ban_for_next_n_days;
            $user->save();
        }
        return back();
    }


    public function bannedStatus(Request $request)
    {

        $user_id = $request->user_id;
        $user = User::find($user_id);
        // dd($user->banned_till != null);
        $message = "The user is not banned";
        if ($user->banned_till != null) {
            if ($user->banned_till == 0) {
                $message = "Banned Permanently";
                return back()->with('message', $message);
            }

            if (now()->lessThan($user->banned_till)) {
                $banned_days = now()->diffInDays($user->banned_till) + 1;
                $message = "Suspended for " . $banned_days . ' ' . Str::plural('day', $banned_days);
                return back()->with('message', $message);
            }
        }
        return back()->with('message', $message);
    }


    public function unban(Request $request)
    {
        $user_id = $request->user_id;
        $user = User::find($user_id);
        if ($user->banned_till == null) {return back()->with('message' ,'user already revoked');}
        $user->banned_till = null;
        $user->save();
        return back()->with('message' ,'user revoked successfully');
    }
}
