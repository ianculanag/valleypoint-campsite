<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    // Table Name
    protected $table = 'accommodation';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    // References Staff
    public function staff()
    {
        return $this->belongsTo('App\Staff');
    }

    // References Units
    public function units()
    {
        return $this->belongsTo('App\Units');
    }
}
