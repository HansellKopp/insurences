<?php

namespace App\Http\Resources;

use App\Policy;
use Illuminate\Support\Optional;
use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\Policy as PolicyResource;
use App\Http\Resources\ClientDocument as ClientDocumentResource;

class Client extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $policiesData = [];
        $policies = $this->policies;
        if($policies) {
            foreach ($policies as $policy) {
                $policiesData[] = [ 
                    'id' => $policy->id,
                    'number'=> $policy->number,
                    'branch' => $policy->branch->name, 
                    'validity'=> [
                        'from' => $policy->from,
                        'to' => $policy->to,
                    ],       
                ];  
                   
            }   
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'dni' => $this->dni,
            'birthDate' => $this->birth_date,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'policies' => $policiesData,
            'documents' => ClientDocumentResource::collection($this->documents),
        ];
    }
}
