<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $filliable = [
        'number',
        'from',
        'to',
        'amount',
        'insurence_id'
    ];

    public function insurence() 
    {
        $this->belongsTo(Insurence::class);
    }
}
