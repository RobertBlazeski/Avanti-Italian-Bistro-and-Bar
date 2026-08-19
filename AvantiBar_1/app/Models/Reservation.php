<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id', 
        'name', 
        'email', 
        'phone', 
        'guests', 
        'datetime', 
        'class', 
        'status',
        'restaurant_table_id'
    ];
    protected $casts = [
        'datetime' => 'datetime', 
    ];

    protected $dates = ['datetime'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function table()
    {
        return $this->belongsTo(RestaurantTable::class, 'restaurant_table_id');
    }
}