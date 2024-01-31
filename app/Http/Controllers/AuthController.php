<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;


class AuthController extends Controller

{     
    public function create()
    {
        return view('register');
    }
    //register
    public function register(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);


        $user = User::create([
            'name' => $validator['name'],
            'email' => $validator['email'],
            'password' => Hash::make($validator['password']),
        ]);

        // $success = $user->createToken('Myapp')->accessToken;

        // return response(["user:" => $user, "token:" => $success]);
        event(new Registered($user));

        Auth::login($user);
        return redirect()->intended('login');
    }
    //login
    public function login(Request $request)
    {
        $feilds = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('email', $feilds['email'])->first();

        if (!$user) {
            return  response(["Email ID not found"], 401);
        }
        $token = $user->createToken('token')->accessToken;
       // return response('token')->cookie('access_token', $token);

       // return response(['user login..' => $user, "token" => $token]);
       return redirect()->intended('dashboard');
        // && response([$token])
        // return 'login...';
    }

    //dashboard
    public function dashboard()
    {
        $user = Auth::guard('api')->user();

        return response(['welcome to dashboard user name' => $user]);

        //  return 'dashboard';
    }
    public function showUsers(){
        $users = $this->getUser();

        // Pass the user data to the Blade view
        return view('dashboard', ['users' => $users]);
    }
    //get user details
    public function getUser()
    {
        $user = Auth::guard('api')->user();
        return response(['user data:' => $user]);
    }

    //logout
    public function logout()
    {

        $accessToken = Auth::guard('api')->user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update(['revoked' => true]);
        $accessToken->revoke();
        return response(['data' => ' user logout...'], 200);
    }
}
