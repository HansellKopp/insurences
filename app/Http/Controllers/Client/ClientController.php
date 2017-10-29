<?php

namespace App\Http\Controllers\Client;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();

        return response()->json(['data' => $clients], 200);
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

        return response()->json(['data' => $item], 201);
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

        return response()->json(['data' => $client], 200);
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

        return response()->json(['data' => $client], 200);
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

        return response()->json(['data' => $client], 200);
    }
}
