<?php

namespace App\Http\Controllers\Client;

use App\Client;
use App\ClientDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\ClientDocument as ClientDocumentResource;

class ClientDocumentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Client $client)
    {
        $rules = [
            'name' => 'required|unique:client_documents,name,' . $client->id,
            'document' => 'required'           
        ];

        $this->validate($request, $rules);

        $data['client_id'] = $client->id;
        $data['name'] = $request->name;
        $data['document'] = $request->document->store('clients/documents');

        $item = ClientDocument::create($data);

        return new ClientDocumentResource($item);
    }

    /**
     * Display the specified resource.
     * 
     * @param  \App\Client  $client
     * @param  $id document_id
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client, $id)
    {
        $item = $client->documents()->find($id);

        if(!$item)
        {
            throw new ModelNotFoundException('Data not found');
        }

        return response()->download(storage_path("app/{$item->document}"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @param  $id document_id
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client,  $id)
    {
        $item = $client->documents()->find($id);
        
        if(!$item)
        {
            throw new ModelNotFoundException('Data not found');
        }

        $item->delete();

        Storage::delete($item->document);

        return new ClientDocumentResource($item);
    }
}
