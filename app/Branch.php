<?php

namespace App;

use App\Insurence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['name'];

    public function insurences()
    {
        return $this->hasMany(Insurrence::class);
    }
}
