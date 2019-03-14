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
    public function accommodationUnit()
    {
        return $this->hasMany('App\AccommodationUnits');
    }

     // Foreign Key to
     public function charge()
     {
         return $this->hasMany('App\Charges');
     }

    // References Staff
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // References Services
    public function service()
    {
        return $this->belongsTo('App\Services');
    }
}
