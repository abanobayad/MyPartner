<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{


    public function register(Request $request)
    {
        // $data = $request->validate(['name'=> 'required','email'=> 'required','password'=> 'required|integer','c_password'=> 'required|integer',]);

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|integer',
                'c_password' => 'required|same:password'
            ]
        );

        if ($validator->fails()) {
            return $this->SendError('Error Of Validation', $validator->errors());
        }
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken($user->name)->plainTextToken;
        $success['name'] = $user->name;

        return $this->SendResponse($success, "User Registered");
    }
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken($user->name)->plainTextToken;
            $success['name'] = $user->name;
            return $this->SendResponse($success, "User Login Successfully");
        } else {
            return $this->SendError("wrong email or password");
        }
    }



    public function logout(Request $request)
    {

        $request->user()->currentAccessToken()->delete();

            return $this->SendResponse( 'logout', "User Logout Successfully");
    }
}
