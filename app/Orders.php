<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //

    protected $fillable = [
        'id', 'tableNumber', 'queueNumber', 'totalBill', 'discountAmount', 'status'
    ];
    // Foreign Key to
    public function additionalCharge()
    {
        return $this->hasMany('App\AdditionalCharges');
    }
}
