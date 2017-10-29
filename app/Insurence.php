<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insurence extends Model
{
    protected $fillable = [
        'number',
        'from',
        'to',
        'pay_form',
        'amount',
        'gainings',
        'bonus',
        'currency',
        'company_id',
        'client_id',
        'taker_id',
        'branch_id'
    ];

    public function company() 
    {
        $this->belongsTo(App\Company::class);
    }

    public function client() 
    {
        $this->belongsTo(App\Client::class);
    }

    public function taker() 
    {
        $this->belongsTo(App\Taker::class);
    }

    public function branch() 
    {
        $this->belongsTo(App\Branch::class);
    }
}
