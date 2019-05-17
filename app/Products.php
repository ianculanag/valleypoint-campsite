<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //use softDeletes;

    protected $dates = ['deleted_at'];

    // Table Name
    protected $table = 'products';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable = [
        'productCategory', 'productName', 'price'
    ];
}
