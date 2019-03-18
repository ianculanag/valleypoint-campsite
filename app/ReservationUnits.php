<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use CoenJacobs\EloquentCompositePrimaryKeys\HasCompositePrimaryKey;

class ReservationUnits extends Model
{
    use HasCompositePrimaryKey;
   
    protected $primaryKey = array('reservationID', 'unitID');

    // References Accommodatinos
    public function reservation()
    {
        return $this->belongsTo('App\Reservation');
    }

    // References Accommodatinos
    public function unit()
    {
        return $this->belongsTo('App\Units');
    }
}
