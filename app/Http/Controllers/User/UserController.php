<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserResource::collection(User::paginate());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:clients',
            'email' => 'required|unique:clients',
            'password' => 'required|confirmed|min:6',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $data['verified'] =  User::NOT_VERIFIED;

        $data['verification_token'] = User::generateVerificationToken();

        $data['remember_token'] = User::generateRememberToken();

        $user = User::create($data);

        return new UserResource($user,201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|unique:users,name,' . $user->id,
            'email' => 'email|unique:users,email,' . $user->id,
            'password' => 'required|confirmed|min:6',
        ];
        
        $user->fill($request->all());

        $this->validate($request, $rules);

        $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
        
        $user['verified'] =  User::NOT_VERIFIED;
        
        $user['verification_token'] = User::generateVerificationToken();
        
        $user['remember_token'] = User::generateRememberToken();

        $user->save();

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return new UserResource($user);
    }

    /**
     *  verify user verification token
     * 
     *  @param string $token
     * 
     *  @return User $user
     */
    public function verify($token)
    {
       $user = User::where('verification_token',$token)->firstOrFail();

       $user->verified = User::VERIFIED;

       $user->verification_token = null;

       $user->save();

       return new UserResource($user);
    }
}
