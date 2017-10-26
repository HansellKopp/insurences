<?php

namespace App;

use App\Insurence;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['name'];

    public function insurences()
    {
        $this->hasMany(Insurrence::class)
    }
}
