<?php

namespace App\Http\Controllers\Policy;

use App\Policy;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\ApiController;

class PolicyController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $policies = Policy::all();

        return $this->showAll($policies);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function show(Policy $policy)
    {
        return $this->showOne($policy);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Policy $policy)
    {
        $rules = [
            'number' => 'required|unique:policies,number,' . $policy->id,
            'from' => 'required|date',
            'to' => 'required|date',
            'pay_form' => [
                'required',
                Rule::in(Policy::payForms())
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

        $policy->fill($request->all());

        $this->checkClean($policy);

        $policy->save();

        return $this->showOne($policy, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Policy $policy)
    {
        $policy->delete();
        
        return $this->showOne($policy);
    }
}
