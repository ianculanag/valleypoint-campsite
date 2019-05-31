<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoidTransactions extends Model
{
    // Table Name
    protected $table = 'void_transactions';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;    

    protected $fillable = [
        'accommodationID', 'reservationID', 'userID', 'remarks'
    ];
}
