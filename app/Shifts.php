<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shifts extends Model
{
    // Table Name
    protected $table = 'shifts';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    // References Staff
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function payment()
    {
        return $this->hasMany('App\Payments');
    }
}
