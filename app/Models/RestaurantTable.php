<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantTable extends Model
{
    use HasFactory;

    protected $fillable = [
        'capacity', 
        'class', 
        'status'
    ];

    // Relationships and methods can be added here as needed
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // Scope to find available tables
    public function scopeAvailable($query)
    {
        return $query->where('status', 'free');
    }

    // Scope to filter by capacity
    public function scopeWithCapacity($query, $capacity)
    {
        return $query->where('capacity', $capacity);
    }

    // Scope to filter by class
    public function scopeWithClass($query, $class)
    {
        return $query->where('class', $class);
    }
}