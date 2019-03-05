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

    // References Guests
    public function guest()
    {
        return $this->belongsTo('App\Guests');
    }

    // References Services
    public function service()
    {
        return $this->belongsTo('App\Services');
    }
}
