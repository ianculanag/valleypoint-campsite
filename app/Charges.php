<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charges extends Model
{
    // Table Name
    protected $table = 'charges';
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
        'remarks', 'serviceID', 'quantity', 'totalPrice', 'accommodationID', 'balance'
    ];    

    // References Accommodation
    public function accommodation()
    {
        return $this->belongsTo('App\Accommodations');
    }

    // References Service
    public function service()
    {
        return $this->belongsTo('App\Services');
    }

    // Foreign Key to
    public function payment()
    {
        return $this->hasMany('App\Payments');
    }
}
