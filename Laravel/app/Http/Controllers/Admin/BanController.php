<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;

class BanController extends Controller
{
    public function ban($user_id, $n)
    {
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
        return redirect(route('admin.home'));
    }


    public function bannedStatus($user_id)
    {
        $user = User::find($user_id);
        $message = "The user is not banned";
        if ($user->banned_till != null) {
            if ($user->banned_till == 0) {
                $message = "Banned Permanently";
            }

            if (now()->lessThan($user->banned_till)) {
                $banned_days = now()->diffInDays($user->banned_till) + 1;
                $message = "Suspended for " . $banned_days . ' ' . Str::plural('day', $banned_days);
            }
        }
        return back()->with('message', $message);
    }


    public function unban($user_id)
    {
        $user = User::find($user_id);
        $user->banned_till = null;
        $user->save();
    }
}
