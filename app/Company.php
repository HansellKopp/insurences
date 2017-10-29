<?php

namespace App;

use App\Insurence;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'dni', 'address', 'phone', 'email'];

    public function insurences()
    {
        $this->hasMany(Insurrence::class);
    }
}
