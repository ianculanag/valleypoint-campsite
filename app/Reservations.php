<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    // Table Name
    protected $table = 'reservations';
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
        'status', 'lastName', 'firstName', 'numberOfPax', 'numberOfUnits', 'contactNumber'
    ];    
    
    // Foreign Key to
    public function reservationUnit()
    {
        return $this->hasMany('App\ReservationUnits');
    }
}
