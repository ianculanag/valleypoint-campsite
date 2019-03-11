<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //

    // Foreign Key to
    public function additionalCharge()
    {
        return $this->hasMany('App\AdditionalCharges');
    }
}
