<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Ingredients extends Model
{
    //use softDeletes;

    protected $dates = ['deleted_at'];

    // Table Name
    protected $table = 'ingredients';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable = [
        'ingredientCategory', 'ingredientName'
    ];
    public static function getAllCategories(){
        $ingredientCategory = DB::select(DB::raw('SHOW COLUMNS FROM ingredients WHERE Field = "ingredientCategory"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $ingredientCategory, $matches);
        $values = array();
        foreach(explode(',', $matches[1]) as $value){
            $values[] = trim($value, "'");
        }
        return $values;
    }
}
