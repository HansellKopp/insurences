<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Receipt extends Resource
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
            'number' => $this->number,
            'lapse' => [
                'from' => $this->from,
                'to' => $this->to,
            ],
            'amount' => $this->amount
        ];
    }
}
