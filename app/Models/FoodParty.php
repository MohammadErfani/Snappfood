<?php

namespace App\Models;

use App\Models\Admin\Discount;
use App\Models\Restaurant\Food;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FoodParty extends Model
{
    use HasFactory;

    protected $fillable = ['food_count','food_id','discount_id'];

    /**
     * @return BelongsTo
     */
    public function food():BelongsTo
    {
        return $this->belongsTo(Food::class);
    }

    /**
     * @return BelongsTo
     */
    public function discount():BelongsTo
    {
        return $this->belongsTo(Discount::class);
    }
}
