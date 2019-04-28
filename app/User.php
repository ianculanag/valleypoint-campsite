<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Database\Eloquent\softDeletes;


class User extends Authenticatable
{
    //use softDeletes;

    protected $dates = ['deleted_at'];

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'role', 'contactNumber','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Foreign key to
    public function accommodation()
    {
        return $this->hasMany('App\Accommodation');
    }

    // Foreign key to
    public function shift()
    {
        return $this->hasMany('App\Shifts');
    }
}
