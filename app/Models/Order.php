<?php

namespace App\Models;

use App\Models\restaurant\Restaurant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function comment()
    {
        return $this->hasOne(Comment::class);
    }

    public function foods()
    {
        return $this->belongsToMany(User::class)->using(FoodOrder::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
