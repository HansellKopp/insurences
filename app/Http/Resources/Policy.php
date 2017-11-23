<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\Receipt as ReceiptResource;
use App\Http\Resources\PolicyDocument as PolicyDocumentResource;

class Policy extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'validity'=> [
                'from' => $this->from,
                'to' => $this->to,
            ],
            'payForm' => $this->pay_form,
            'amount' => $this->amount,
            'gains' => $this->gains,
            'bonus' => $this->bonus,
            'currency' => $this->currency,
            'company' => $this->company->name,
            'client' => ['name' => $this->client->name,
                         'dni' => $this->client->dni
                        ],
            'taker' =>  ['name' => $this->taker->name,
                        'dni' => $this->taker->dni
                        ],
            'branch' => $this->branch->name,
            'receipts' => ReceiptResource::collection($this->receipts),
            'documents' => PolicyDocumentResource::collection($this->documents),
        ];
    }
}
