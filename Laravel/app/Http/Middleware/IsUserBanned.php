<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\API\BaseController as BS;


class IsUserBanned
{
    public function handle(Request $request, Closure $next)
    {

        if (auth()->check() && auth()->user()->banned_till != null) {
            if (auth()->user()->banned_till == 0) {
                $message = 'Your account has been banned permanently.';
                auth()->user()->tokens()->delete();
            $o  = new BS();
            return  $o->SendError($message);
            }
            if (now()->lessThan(auth()->user()->banned_till)) {
                $banned_days = now()->diffInDays(auth()->user()->banned_till) + 1;
                $message = 'Your account has been suspended for ' . $banned_days . ' ' . Str::plural('day', $banned_days);
                auth()->user()->tokens()->delete();
            $o  = new BS();
            return  $o->SendError($message);
            }

        }

        return $next($request);
    }
}
