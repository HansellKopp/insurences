<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The name attribute must be saved as lowercase at database.
     *
     * @value string
     */
    public function setNameAttribute($value) 
    {
        $this->attributes['name'] = strtolower($value);
    }

    /**
     * The name attribute must be show with only first letter capitalized.
     *
     */
    public function getNameAttribute()
    {
        return ucwords($this->attributes['name']);
    }

    /**
     * The email attribute must be saved as lowercase at database.
     *
     * @value string
     */
    public function setEmailAttribute($value) 
    {
        $this->attributes['email'] = strtolower($value);
    }

}
