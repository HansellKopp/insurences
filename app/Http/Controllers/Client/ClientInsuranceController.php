<?php

namespace App\Http\Controllers\Client;

use App\Client;
use App\Policy;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\ApiController;

class ClientPolicyController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function index(Client $client)
    {
        $policies = $client->policies;
        
        return $this->showAll($policies);
    }

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

        $data = $request->all();

        $data['client_id'] = $client->id;

        $item = Policy::create($data);

        return $this->showOne($item, 201);
    }

}
