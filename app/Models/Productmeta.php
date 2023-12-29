<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productmeta extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id','product_attribute_id','value'
     ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // product_attribute
    public function product_attribute()
    {
        return $this->belongsTo(Productattribute::class);
    }
}
