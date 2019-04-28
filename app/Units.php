<?php

namespace App;

//use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Database\Eloquent\Model;
//use Kyslik\ColumnSortable\Sortable;

class Units extends Model
{
    //use softDeletes;

    protected $softDelete = true;

    protected $dates = ['deleted_at'];

    // Table Name
    protected $table = 'units';
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
        'id', 'unitType', 'unitNumber', 'capacity', 'created_at', 'updated_at', 'deleted_at'
    ];

	//public $sortable = ['id', 'unitType', 'unitNumber', 'capacity'];

    // Foreign key to
    public function accommodation()
    {
        return $this->hasMany('App\Accommodation');
    }

    // Foreign Key to
    public function accommodationUnit()
    {
        return $this->hasMany('App\AccommodationUnits');
    }
}
