<?php

namespace App\Http\Controllers\Policy;

use App\Policy;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\Policy as PolicyResource;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PolicyResource::collection(Policy::paginate());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function show(Policy $policy)
    {
        return new PolicyResource($policy);
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

        if($policy->isClean()) {
            throw new ResourceCleanException();
        }

        $policy->save();

        return new PolicyResource($policy, 201);
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
        
        return new PolicyResource($policy);
    }

    /* Display a listing of policies with expiration's date between dates
    *
    * @param  Request $request
    * @return \Illuminate\Http\Response
    */
   public function expirations(Request $request)
   {
       $rules = [
           'from' => 'required|date',
           'to' => 'required|date'
       ];

       $request->validate($rules);

       $to = $request->to;
       $from = $request->from;

       $policies = Policy::whereRaw("DAYOFYEAR(to) >= DAYOFYEAR('${from}') and DAYOFYEAR(to) <= DAYOFYEAR('${to}')")
               ->orderByRaw('DAYOFYEAR(to)')
               ->paginate();

       return PolicyResource::collection($policies);
   }
}
