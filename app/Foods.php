<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foods extends Model
{
    //use softDeletes;

    protected $dates = ['deleted_at'];

    // Table Name
    protected $table = 'foods';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable = [
        'foodCategory', 'foodName', 'price'
    ];
}
