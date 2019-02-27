<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Units extends Model
{
    // Table Name
    protected $table = 'units';
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
