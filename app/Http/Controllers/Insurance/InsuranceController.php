<?php

namespace App\Http\Controllers\Insurance;

use App\Insurance;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\ApiController;

class InsuranceController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $insurances = Insurance::all();

        return $this->showAll($insurances);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Insurance  $insurance
     * @return \Illuminate\Http\Response
     */
    public function show(Insurance $insurance)
    {
        return $this->showOne($insurance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Insurance  $insurance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Insurance $insurance)
    {
        $rules = [
            'number' => 'required|unique:insurances,number,' . $insurance->id,
            'from' => 'required|date',
            'to' => 'required|date',
            'pay_form' => [
                'required',
                Rule::in(Insurance::payForms())
            ],
            'amount' => 'required|numeric',
            'gains' => 'required|numeric',
            'bonus' => 'required|numeric',
            'currency' => 'required',
            'taker_id' => 'exists:clients,id',
            'client_id' => 'required|exists:clients,id',
            'company_id' => 'exists:companies,id',
            'branch_id' => 'exists:branches,id',
            
        ];

        $this->validate($request, $rules);

        $insurance->fill($request->all());

        $this->checkClean($insurance);

        $insurance->save();

        return $this->showOne($insurance, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Insurance  $insurance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Insurance $insurance)
    {
        $insurance->delete();
        
        return $this->showOne($insurance);
    }
}
