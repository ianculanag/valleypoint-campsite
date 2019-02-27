<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    // Table Name
    protected $table = 'staff';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    // Foreign key to
    public function accommodation()
    {
        return $this->hasMany('App\Accommodation');
    }
}
