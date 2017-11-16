<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->showAll(User::all());
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
        ];

        $this->validate($request, $rules);

        $user = Client::create($request->all());

        $user->verified = User::NOT_VERIFIED;

        return $this->showOne($user, 201);
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
        ];

        $this->validate($request, $rules);

        $user->fill($request->all());

        $this->checkClean($user);

        $user->verified = User::NOT_VERIFIED;

        $user->save();

        return $this->showOne($user);
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

        return $this->showOne($user);
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
       $user = User::where('verification_token',$token)->firsOrFail();

       $user->verified = User::VERIFIED;

       $user->token = null;

       $user->save();

       return $this->showOne($user);
    }
}
