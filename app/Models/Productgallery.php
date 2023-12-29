<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productgallery extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    //  Tbale name 
    protected $table = 'productgallery';
    protected $fillable = [
        'product_id','image'
     ];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
