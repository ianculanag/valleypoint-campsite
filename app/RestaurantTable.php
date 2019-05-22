<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantTable extends Model
{
    //
    // Table Name
    protected $table = 'restaurant_tables';
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
        'id', 'tableNumber', 'status', 'created_at', 'updated_at'
    ];
}
