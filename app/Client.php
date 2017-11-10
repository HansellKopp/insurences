<?php

namespace App;

use App\Policy;
use App\Client\Document;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'dni', 'birth_date', 'address', 'phone', 'email'];
    
    public function policies()
    {
        return $this->hasMany(Policy::class);
    }

    public function documents()
    {
        return $this->hasMany(ClientDocument::class);
    }
}
