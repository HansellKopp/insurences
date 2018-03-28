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
            'id' => $this->id,
            'name' => $this->name, 
            'dni' => $this->dni,
            'contact_name' => $this->contact_name,
            'address' => $this->address, 
            'phone' => $this->phone, 
            'email' => $this->email,
            'policies_count' => $this->policies()->count(),
        ];
    }
}
