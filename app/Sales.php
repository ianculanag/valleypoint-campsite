<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    // Table Name
    protected $table = 'sales';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = [
    //    'totalPrice', 'paymentStatus'
    //];

    // References Accommodation
    public function accommodation()
    {
        return $this->belongsTo('App\Accommodation');
    }

    // References Orders
    public function order()
    {
        return $this->belongsTo('App\Orders');
    }

    // References Services
    public function service()
    {
        return $this->belongsTo('App\Services');
    }
}
