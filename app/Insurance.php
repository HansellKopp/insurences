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
    
    const CASH = 'cash';
    const CREDIT = 'credit';
   
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'number',
        'from',
        'to',
        'pay_form',
        'amount',
        'gains',
        'bonus',
        'currency',
        'company_id',
        'client_id',
        'taker_id',
        'branch_id'
    ];

    public static function payForms()
    {
        return [self::CASH, self::CREDIT];
    }

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
