<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData, [
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        $user = User::create($requestData);
        return response([ 'status' => true, 'message' => 'User successfully register.', 'data' => $user ], 200);
    }
    public function login(Request $request)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData, [
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        if(!Auth::attempt($requestData)) {
            return response()->json(['error' => 'UnAuthorised Access'], 401);
        }
        $accessToken = Auth::user()->createToken('apiToken')->accessToken;
        return response()->json([
            'user' => auth()->user(),
            'access_token' => $accessToken
        ], 200);
    }
    public function me(Request $request)
    {
        $user = $request->user();
        return response()->json(['user' => $user], 200);
    }
    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}
