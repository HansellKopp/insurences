<?php

namespace App;

use App\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientDocument extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $fillable = ['name','document','client_id'];

    public function client() 
    {
        return $this->belongsTo(Client::class);
    }
}
