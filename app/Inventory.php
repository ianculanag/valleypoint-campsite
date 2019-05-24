<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    // Table Name
    protected $table = 'inventories';
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
        'id', 'date', 'quantity', 'ingredientID', 'updated_at', 'deleted_at'
    ];
}
