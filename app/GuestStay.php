<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestStay extends Model
{
    // Table Name
    protected $table = 'guest_stays';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    // References Staff
    public function guests()
    {
        return $this->belongsTo('App\Guests');
    }

    // References Staff
    public function accommodation()
    {
        return $this->belongsTo('App\Accommodation');
    }
}
