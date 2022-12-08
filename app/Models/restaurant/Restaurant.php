<?php

namespace App\Models\restaurant;

use App\Models\Address;
use App\Models\admin\RestaurantCategory;
use App\Models\Comment;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'phone', 'bank_account', 'picture', 'salesman_id','is_open'];
    protected $with=['address','schedules','comments','foods'];

    public function restaurantCategories():BelongsToMany
    {
        return $this->belongsToMany(RestaurantCategory::class);
    }

    /**
     * @return MorphOne
     */
    public function address():MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    /**
     * @return HasMany
     */
    public function schedules():HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * @return BelongsTo
     */
    public function salesman():BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    /**
     * @return HasManyThrough
     */
    public function comments():HasManyThrough
    {
        return $this->hasManyThrough(Comment::class, Order::class);
    }

    /**
     * @return HasMany
     */
    public function orders():HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return HasMany
     */
    public function foods():HasMany
    {
        return $this->hasMany(Food::class);
    }

    /**
     * @return HasMany
     */
    public function foodCategories()
    {
        return $this->foods()->join('food_food_category','food.id','=','food_food_category.food_id')
            ->join('food_categories','food_food_category.food_category_id','=','food_categories.id')
            ->select('food_categories.*')->distinct();
    }

    /**
     * ToDo: save schedules
     * @param array $times
     * @param bool $all
     * @return void
     */
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

    /**
     * Todo: update schedules
     * @param array $times
     * @param bool $all
     * @return void
     */
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

    /**
     * Todo: calculate score of restaurant
     * @return float|int|string
     */
    public function score():float|int|string
    {
        $scores = $this->comments->pluck('score')->toArray();
        return count($scores)!==0 ?array_sum($scores)/count($scores):"doesn't have score yet";
    }
}
