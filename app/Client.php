<?php

namespace App;

use App\Insurence;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'dni', 'birth_date', 'address', 'phone', 'email'];
    
    public function insurences()
    {
        $this->hasMany(Insurrence::class);
    }
}
