<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

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

    public static function getAllCategories(){
        $productCategory = DB::select(DB::raw('SHOW COLUMNS FROM products WHERE Field = "productCategory"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $productCategory, $matches);
        $values = array();
        foreach(explode(',', $matches[1]) as $value){
            $values[] = trim($value, "'");
        }
        return $values;
    }
}
