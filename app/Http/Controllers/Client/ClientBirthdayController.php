<?php

namespace App\Http\Controllers\Client;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;

class ClientBirthdayController extends ApiController
{
        /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
                ->get();

        return $this->showAll($clients);
    }
}
