<?php
namespace App\Models\Admin;

use App\Models\Restaurant\Food;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodCategory extends Model
{
    use HasFactory ,SoftDeletes;
    protected $fillable = ['name','picture','parent_category'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function foods():BelongsTo
    {
        return $this->belongsToMany(Food::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent():BelongsTo
    {
        return $this->belongsTo(FoodCategory::class, 'parent_category');
    }
}
