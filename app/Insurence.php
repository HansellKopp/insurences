<?php

namespace App;

use App\Company;
use App\client;
use App\Taker;
use App\Branch;
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
        $this->belongsTo(Company::class)
    }

    public function client() 
    {
        $this->belongsTo(Client::class)
    }

    public function taker() 
    {
        $this->belongsTo(Taker::class)
    }

    public function branch() 
    {
        $this->belongsTo(Branch::class)
    }
}
