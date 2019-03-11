<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    // Table Name
    protected $table = 'accommodations';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    

    // Foreign Key to
    public function guest()
    {
        return $this->hasMany('App\Guests');
    }

    // Foreign Key to
    public function additionalCharge()
    {
        return $this->hasMany('App\AdditionalCharges');
    }

    // References Staff
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // References Units
    public function units()
    {
        return $this->belongsTo('App\Units');
    }

    // References Services
    public function service()
    {
        return $this->belongsTo('App\Services');
    }
}
