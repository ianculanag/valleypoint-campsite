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
    public function staff()
    {
        return $this->belongsTo('App\Staff');
    }
}
