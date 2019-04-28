<?php

namespace App;

//use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    //use softDeletes;

    protected $dates = ['deleted_at'];

    // Table Name
    protected $table = 'services';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    // Foreign key to
    public function accommodation()
    {
        return $this->hasMany('App\Accommodation');
    }
    
    // Foreign Key to
    public function additionalCharge()
    {
        return $this->hasMany('App\AdditionalCharges');
    }

    // Foreign Key to
    public function sale()
    {
        return $this->hasMany('App\Sales');
    }

    // Foreign Key to
    public function charge()
    {
        return $this->hasMany('App\Charges');
    }

    protected $fillable = [
        'serviceType', 'serviceName', 'price', 'leanPrice', 'peakPrice'
    ];
}
