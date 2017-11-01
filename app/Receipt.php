<?php

namespace App;

use App\Insurence;
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
        'insurence_id'
    ];

    public function insurence() 
    {
        $this->belongsTo(Insurence::class);
    }
}
