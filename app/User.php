<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;
    
    const VERIFIED = 'verified';
    const NOT_VERIFIED = 'not verified';

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password','verification_token'
    ];

    /**
     * Generate user verification token
     * 
     * @return string
     */
     public static function generateVerificationToken()
     {
        return str_random(40);
     }

    /**
     * Generate user verification token
     * 
     * @return string
     */
    public static function generateRememberToken()
    {
       return str_random(20);
    }

    /**
     * The name attribute must be saved as lowercase at database.
     *
     * @return @value string
     */
    public function setNameAttribute($value) 
    {
        return $this->attributes['name'] = strtolower($value);
    }

    /**
     * The name attribute must be show with only first letter capitalized.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return ucwords($this->attributes['name']);
    }

    /**
     * The email attribute must be saved as lowercase at database.
     *
     * @param value string
     * 
     * @return string
     */
    public function setEmailAttribute($value) 
    {
        return $this->attributes['email'] = strtolower($value);
    }

}
