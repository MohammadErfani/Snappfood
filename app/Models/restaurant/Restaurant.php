<?php

namespace App\Models\restaurant;

use App\Models\Address;
use App\Models\admin\RestaurantCategory;
use App\Models\Comment;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    public function restaurantCategories()
    {
        return $this->belongsToMany(RestaurantCategory::class);
    }
/*
 * return the address for restaurant
 */
    public function address()
    {
        return $this->morphOne(Address::class,'addressable');
    }
    /*
     * return the salesman
     */
    public function salesman(){
        return $this->belongsTo(Restaurant::class);
    }

    public function comments()
    {
        return $this->hasManyThrough(Comment::class,Order::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function foods()
    {
        return $this->hasMany(Food::class);
    }
}
