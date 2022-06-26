<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class FacebookLoginController extends Controller
{
    public function login(Request $request)
    {
        $token = $request->token;
        $providerUser = Socialite::driver("facebook")->userFromToken($token);
        $userProviderId = $providerUser->id;
        $user = User::where('provider_name', "facebook")->where('provider_id', $userProviderId)->first();
        if ($user == null) {
            $user = new User();
            $user->name  = $providerUser->name;
            $user->email= $providerUser->email;
            $user->provider_name = 'facebook';
            $user->provider_id = $providerUser->id;
            $user->avatar = "https://graph.facebook.com/v3.3/$userProviderId/picture?type=large&access_token=$token";
            $user->save();
        }
        $accessToken = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            "status" => "success",
            "access_token" => $accessToken,
            "username" => $user->name,
            "avatar" => $user->avatar,
        ]);
    }
}
