<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','short_description','long_description','slug','image','price','is_active','category_id','sub_category_id','manufacturer_id'
     ];
     
    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function productmeta()
    {
        return $this->hasMany(Productmeta::class);
    }

    public function productgallery()
    {
        return $this->hasMany(Productgallery::class);
    }
    
}
