<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Company extends Resource
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
            'name' => $this->name, 
            'dni' => $this->dni, 
            'address' => $this->address, 
            'phone' => $this->phone, 
            'email' => $this->email,
        ];
    }
}
