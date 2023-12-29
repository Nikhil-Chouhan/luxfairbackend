<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_slug', 'category_title', 'category_img','is_active','category_description'
    ];

    public function subcategory()
    {
        return $this->hasMany(Subcategory::class);
    }

}
