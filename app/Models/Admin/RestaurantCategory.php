<?php

namespace App\Models\Admin;

use App\Models\Restaurant\Restaurant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'picture', 'parent_category'];

    /**
     * @return BelongsToMany
     */
    public function restaurants():BelongsToMany
    {
        return $this->belongsToMany(Restaurant::class);
    }

    /**
     * @return BelongsTo
     */
    public function parent():BelongsTo
    {
        return $this->belongsTo(RestaurantCategory::class, 'parent_category');
    }
}
