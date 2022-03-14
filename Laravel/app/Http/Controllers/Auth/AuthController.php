<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;

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
            throw new AuthenticationException();
        }
    }
}
