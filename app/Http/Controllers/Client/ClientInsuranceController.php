<?php

namespace App\Http\Controllers\Client;

use App\Client;
use App\Insurance;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\ApiController;

class ClientInsuranceController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Client $client)
    {
        $insurances = $client->insurances;
        
        return $this->showAll($insurances);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * http headers must contain: [X-Requested-With: XMLHttpRequest]
     */
    public function store(Request $request, Client $client)
    {   
        $rules = [
            'number' => 'required|unique:insurances',
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
            'company_id' => 'exists:companies,id',
            'branch_id' => 'exists:branches,id',
            
        ];

        
        $this->validate($request, $rules);

        $data = $request->all();

        $data['client_id'] = $client->id;

        $item = Insurance::create($data);

        return $this->showOne($item, 201);
    }
}
