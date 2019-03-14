<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use CoenJacobs\EloquentCompositePrimaryKeys\HasCompositePrimaryKey;

class AccommodationUnits extends Model
{
    use HasCompositePrimaryKey;
   
    protected $primaryKey = array('accommodationID', 'unitID');

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
