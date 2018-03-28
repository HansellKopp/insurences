<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;


class ApiAuthController extends Controller
{
	public function __construct()
	{
	    $this->middleware('auth:api')->only('logout');
    }
    
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|between:6,25'
        ]);
        $user = User::where('email', $request->email)
            ->first();
        if($user && Hash::check($request->password, $user->password)) {
            // generate new api token
            $user->api_token = $user->generateApiToken();
            $user->save();
            return response()
                ->json([
                    'authenticated' => true,
                    'api_token' => $user->api_token,
                    'user_id' => $user->id,
                    'username' => $user->name
                ], 200);
        }
        return response()
            ->json([
                'email' => ['Provided email and password does not match!']
            ], 422);
    }
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->api_token = null;
        $user->save();
        return response()
            ->json([
                'done' => true
            ], 200);
    }
}