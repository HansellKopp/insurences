<?php
namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $rules = [
        'name' => 'required|unique:clients|max:100',
        'dni' => 'required|unique:clients|max:10',
        'address' => 'max:100',
        'phone' => 'max:100',
        'email' => 'max:100'
    ];

    public function getClients() 
    {
        $clients = Client::all();
        $response = [
            'clients' => $clients
        ];
        return response()->json($response, 200);
    }

    public function getClientById($id) 
    {
        $client = Client::find($id);
        if (!$client) 
        {
            $response = [
                'message' => 'Client not found'
            ];
            return response()->json($response, 404);
        }
        $response = [
            'client' => $client
        ];
        return response()->json($response, 200);
    }

    public function postClient(Request $request) 
    {
        $client = new Client();
        $request->validate($this->rules);
        $result = $client->create($request->all());
        $data = [
            'client' => $result
        ];
        return response()->json($data, 201);
    }

    public function putClient(Request $request, $id) 
    {
        $client = Client::find($id);
        if (!$client) 
        {
            $response = [
                'message' => 'Client not found'
            ];
            return response()->json($response, 404);
        }        
        try 
        {
          $client->update($request->all());
        } catch(Exception $e)
        {
            return response()->json(['message' => $e->getMessage()], 500);
        }       
        $data = [
            'client' => $client
        ];
        return response()->json($data, 200);
    }

    public function deleteClient($id) 
    {
        $client = Client::find($id);
        if (!$client) 
        {
            $data = [
                'message' => 'Client not found'
            ];
            return response()->json($data, 404);
        }
        $client->delete();
        return response()->json([], 200);
    }
}