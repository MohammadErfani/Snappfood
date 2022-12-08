<?php

namespace App\Models\restaurant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Todo: set Weekday as number of date base on Carbon
     */
    const WEEKDAY = [
        'sunday'=>0,
        'monday'=>1,
        'tuesday'=>2,
        'wednesday'=>3,
        'thursday'=>4,
        'friday'=>5,
        'saturday'=>6,
    ];

    protected $fillable = ['weekday', 'open_hour', 'close_hour', 'restaurant_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function restaurant():BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

}
