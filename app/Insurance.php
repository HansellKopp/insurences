<?php

namespace App;

use App\Company;
use App\Client;
use App\Taker;
use App\Branch;
use App\Receipt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Insurance extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

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
        return $this->belongsTo(Company::class);
    }

    public function client() 
    {
        return $this->belongsTo(Client::class);
    }

    public function taker() 
    {
        return $this->belongsTo(Taker::class);
    }

    public function branch() 
    {
        return $this->belongsTo(Branch::class);
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }
    
}
