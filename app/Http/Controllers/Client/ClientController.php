<?php

namespace App\Http\Controllers\Client;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Exceptions\ResourceCleanException;
use App\Http\Resources\Client as ClientResource;

class ClientController extends ApiController
{
    /**
     * Search
     */
    public function search()
    {
        $results = Client::orderBy('name')
            ->when(request('q'), function($query) {
                $query->where('name', 'like', '%'.request('q').'%')
                      ->orWhere('dni', 'like', '%'.request('q').'%');
            })
            ->limit(6)
            ->get();
        return response()->json(['data' => $results], 200);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Client::query();

        $parameters =  $parameters = request()->query->all();

        $this->sortBy(Client::class, $query, $parameters);

        $this->filterBy(CLient::class, $query, $parameters);
        
        return ClientResource::collection($query->paginate(10));

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
            'email' => 'email',
            'birthday' => 'date'
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

        $client->birthday = $request->birthday;

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

       $clients = Client::whereRaw("DAYOFYEAR(birthday) >= DAYOFYEAR('${from}') and DAYOFYEAR(birthday) <= DAYOFYEAR('${to}')")
               ->orderByRaw('DAYOFYEAR(birthday)')
               ->paginate();

       return ClientResource::collection($clients);
   }
}
