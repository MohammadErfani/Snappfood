<?php

namespace App\Models\restaurant;

use App\Models\admin\FoodCategory;
use App\Models\Comment;
use App\Models\FoodOrder;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name','price','picture','material','restaurant_id'];
    public function foodCategories()
    {
        return $this->belongsToMany(FoodCategory::class);
    }
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->using(FoodOrder::class);
    }
    public function comments(){
        return $this->hasManyThrough(Comment::class,FoodOrder::class,'food_id','order_id','id','order_id');
    }
}
