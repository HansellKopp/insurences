<?php

namespace App;

use App\Insurance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receipt extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $filliable = [
        'number',
        'from',
        'to',
        'amount',
        'insurance_id'
    ];

    public function insurance() 
    {
        return $this->belongsTo(Insurance::class);
    }
}
