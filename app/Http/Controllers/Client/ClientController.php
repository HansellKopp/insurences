<?php

namespace App\Http\Controllers\Client;

use App\Client;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ClientController extends ApiController
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();

        return $this->showAll($clients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * http headers must contain: [X-Requested-With: XMLHttpRequest]
     */
    public function store(Request $request)
    {   
        $rules = [
            'name' => 'required|unique:clients',
            'dni' => 'required|unique:clients',
            'email' => 'email'
        ];

        $this->validate($request, $rules);

        $item = Client::create($request->all());

        return $this->showOne($item, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);

        return $this->showOne($client);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $rules = [
            'name' => 'required|unique:clients,name,' . $client->id,
            'dni' => 'required|unique:clients,dni,' . $client->id,
            'email' => 'email'
        ];

        $this->validate($request, $rules);

        $client->update($request->all());

        return $this->showOne($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);

        $client->delete();

        return $this->showOne($client);
    }
}
