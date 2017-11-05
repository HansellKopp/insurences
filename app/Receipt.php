<?php

namespace App;

use App\Policy;
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
        'policy_id'
    ];

    public function policy() 
    {
        return $this->belongsTo(Policy::class);
    }
}
