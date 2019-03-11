<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdditionalCharges extends Model
{
    // Table Name
    protected $table = 'additional_charges';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'totalPrice', 'paymentStatus'
    ];

    // References Accommodation
    public function accommodation()
    {
        return $this->belongsTo('App\Accommodation');
    }

    // References Services
    public function service()
    {
        return $this->belongsTo('App\Services');
    }

    // References Orders
    public function order()
    {
        return $this->belongsTo('App\Orders');
    }
}
