<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productattribute extends Model
{
    use HasFactory;  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'name','type','group'
    ];

    // Define Table 
    protected $table = 'product_attributes';

}
