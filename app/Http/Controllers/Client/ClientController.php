<?php

namespace App\Http\Controllers\Client;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Client as ClientResource;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ClientResource::collection(Client::paginate(10));
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

        return new ClientResource($item, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return new ClientResource($client);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $rules = [
            'name' => 'required|unique:clients,name,' . $client->id,
            'dni' => 'required|unique:clients,dni,' . $client->id,
            'email' => 'email'
        ];

        $this->validate($request, $rules);

        $client->fill($request->all());

        if($client->isClean()) {
            throw new ResourceCleanException();
        }

        $client->save();

        return new ClientResource($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return new ClientResource($client);
    }

    /* Display a listing of clients with birthday between dates
    *
    * @param  Request $request
    * @return \Illuminate\Http\Response
    */
   public function birthdays(Request $request)
   {
       $rules = [
           'from' => 'required|date',
           'to' => 'required|date'
       ];

       $request->validate($rules);

       $to = $request->to;
       $from = $request->from;

       $clients = Client::whereRaw("DAYOFYEAR(birth_date) >= DAYOFYEAR('${from}') and DAYOFYEAR(birth_date) <= DAYOFYEAR('${to}')")
               ->orderByRaw('DAYOFYEAR(birth_date)')
               ->paginate();

       return ClientResource::collection($clients);
   }
}
