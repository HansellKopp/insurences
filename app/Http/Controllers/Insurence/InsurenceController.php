<?php

namespace App\Http\Controllers\Insurence;

use App\Insurence;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class InsurenceController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $insurences = Insurence::all();

        return $this->showAll($insurences);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Insurence  $insurence
     * @return \Illuminate\Http\Response
     */
    public function show(Insurence $insurence)
    {
        return $this->showOne($insurence);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Insurence  $insurence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Insurence $insurence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Insurence  $insurence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Insurence $insurence)
    {
        //
    }
}
