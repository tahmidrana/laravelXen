<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('userid', $request->username)->first();

        if($user) {
            if(Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return response($response, 200);
            } else {
                $response['message'] = "Password missmatch";
                return response($response, 422);
            }
        } else {
            $response['message'] = 'User does not exist';
            return response($response, 422);
        }
    }

    public function logout (Request $request) 
    {
        $token = $request->user()->token();
        $token->revoke();
    
        $response['message'] = 'You have been succesfully logged out!';
        return response($response, 200);
    }
}
