<?php

namespace App\Models\restaurant;

use App\Models\Address;
use App\Models\admin\RestaurantCategory;
use App\Models\Comment;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'phone', 'bank_account', 'picture', 'salesman_id','is_open'];
    protected $with=['address','schedules','comments','foods'];

    public function restaurantCategories()
    {
        return $this->belongsToMany(RestaurantCategory::class);
    }

    /*
     * return the address for restaurant
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
    /*
     * return the salesman
     */
    public function salesman()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function comments()
    {
        return $this->hasManyThrough(Comment::class, Order::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function foods()
    {
        return $this->hasMany(Food::class);
    }
    public function foodCategories()
    {
        return $this->foods()->join('food_food_category','food.id','=','food_food_category.food_id')
            ->join('food_categories','food_food_category.food_category_id','=','food_categories.id')
            ->select('food_categories.*')->distinct();
    }


    public function saveSchedules(array $times, bool $all = true)
    {
        $schedules = [];
        if ($all) {
            foreach(Schedule::WEEKDAY as $key=>$value) {
                $schedules[] = ['weekday' => $value, 'open_hour' => $times['open'], 'close_hour' => $times['close']];
            }
        }else{
            $open = $times[0];
            $close = $times[1];
            foreach(Schedule::WEEKDAY as $key=>$value) {
                $schedules[] = ['weekday' => $value, 'open_hour' => $open[$key], 'close_hour' => $close[$key]];
            }
        }

        foreach ($schedules as $schedule) {
            $this->schedules()->save(new Schedule($schedule));
        }
    }
    public function updateSchedules(array $times, bool $all = true)
    {
        if ($all) {
            foreach(Schedule::WEEKDAY as $key=>$value) {
                $this->schedules()->where('weekday',$value)->update(['open_hour'=>$times['open'],'close_hour'=>$times['close']]);
            }
        }else{
            $open = $times[0];
            $close = $times[1];
            foreach(Schedule::WEEKDAY as $key=>$value) {
                $this->schedules()->where('weekday',$value)->update([ 'open_hour' => $open[$key], 'close_hour' => $close[$key]]);
            }
        }
    }

    public function score()
    {
        $scores = $this->comments->pluck('score')->toArray();
        return count($scores)!==0 ?array_sum($scores)/count($scores):"doesn't have score yet";
    }
}
