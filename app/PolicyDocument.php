<?php

namespace App;

use App\Policy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PolicyDocument extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $fillable = ['name','document','policy_id'];

    public function policy() 
    {
        return $this->belongsTo(Policy::class);
    }
}
