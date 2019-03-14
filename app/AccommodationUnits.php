<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccommodationUnits extends Model
{
    // References Accommodatinos
    public function accommodation()
    {
        return $this->belongsTo('App\Accommodation');
    }

    // References Accommodatinos
    public function unit()
    {
        return $this->belongsTo('App\Units');
    }
}
