<?php

namespace App;

use App\Insurence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'dni', 'address', 'phone', 'email'];

    public function insurences()
    {
        $this->hasMany(Insurrence::class);
    }
}
