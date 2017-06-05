<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;


class ApiController extends Controller
{
    //

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        $user = auth()->user();
//        exit;
        return response()->json(compact('token', 'user'));
    }

    public function register(RegisterRequest $request)
    {
        $credentials = $request->only('email', 'password', 'name');

        $user = User::create($credentials);
        try {
            // attempt to create a token for the user
            $token = JWTAuth::fromUser($user);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token', 'user'));

    }
}
