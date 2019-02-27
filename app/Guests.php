<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guests extends Model
{
    // Table Name
    protected $table = 'guests';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    // Foreign key to
    public function guestStays()
    {
        return $this->hasMany('App\GuestStay');
    }
}
