<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Kyslik\ColumnSortable\Sortable;

class Units extends Model
{
    //use Sortable;

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
        'status',
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
