<?php

namespace App\Http\Controllers\Client;

use App\Client;
use App\Policy;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\Policy as PolicyResource;

class ClientPolicyController extends Controller
{
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     * http headers must contain: [X-Requested-With: XMLHttpRequest]
     */
    public function store(Request $request, Client $client)
    {   
        $rules = [
            'number' => 'required|unique:policies',
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
            'company_id' => 'exists:companies,id',
            'branch_id' => 'exists:branches,id',
        ];

        $this->validate($request, $rules);

        $data = new Policy($request->all());

        $item = $client->policies()->save($data);

        return new PolicyResource($item, 201);
    }

}
