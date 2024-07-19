<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Laravel Passport User Registration  API Function
     */
    public function register(Request $request)
    {
        //dd($request->all());
        $validator = $request->validate([
            'name'=> 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MY_New_Project')->accessToken;
        $success['message'] = "User Registration Successfully!";
        return response()->json(['data' => $success], 200);
    }

    /**
     * Laravel Passport User Login  API Function
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $userData = User::where('email',$request->input('email'))->first();
        if ($userData) {
            if (Hash::check($request->password, $userData->password)) {
                $success['token'] = $userData->createToken('MY_New_Project')->accessToken;
                $success['massage'] = "Login Successfully!";
                return response()->json(['data'=>$success], 200);
            }
        }else{
            return response()->json(['message'=> 'User does not exist'], 422);
        }
    }
}
