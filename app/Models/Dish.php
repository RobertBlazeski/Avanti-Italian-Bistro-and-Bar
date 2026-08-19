<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $fillable = [
        'name', 
        'category_id', 
        'description', 
        'price', 
        'image'
    ];

    // Helper method to get the full image path
    public function getImageUrlAttribute()
{
    return $this->image ? asset('Images/' . $this->image) : null;
}

    // Optional: Relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}