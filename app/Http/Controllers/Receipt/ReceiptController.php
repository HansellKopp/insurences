<?php

// Dienstag 13:30
//  
   
namespace App\Http\Controllers\Receipt;

use App\Receipt;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ReceiptController extends ApiController
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function show(Receipt $receipt)
    {
        return $this->showOne($receipt);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receipt $receipt)
    {
        $rules = [
            'number' => 'required|unique:receipts,number,' . $receipt->id,
            'from' => 'required|date',
            'to' => 'required|date',
            'amount' => 'required|numeric',
        ];

        $this->validate($request, $rules);

        $receipt['number'] = $request->number;
        $receipt['from'] = $request->from;
        $receipt['to'] = $request->to;
        $receipt['amount'] = $request->amount;

        $this->checkClean($receipt);

        $receipt->save();

        return $this->showOne($receipt, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receipt $receipt)
    {
        $receipt->delete();
        
        return $this->showOne($receipt);
    }
}
