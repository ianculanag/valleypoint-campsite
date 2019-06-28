<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    // Table Name
    protected $table = 'payments';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;


    // References Charges
    public function charge()
    {
        return $this->belongsTo('App\Charges');
    }

    public function shift()
    {
        return $this->belongsTo('App\Shifts');
    }
}
