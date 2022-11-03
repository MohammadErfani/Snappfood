<?php
namespace App\Models\admin;

use App\Models\restaurant\Food;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodCategory extends Model
{
    use HasFactory ,SoftDeletes;
    protected $fillable = ['name','picture','parent_category'];
    public function foods()
    {
        return $this->belongsToMany(Food::class);
    }
    public function parent()
    {
        return $this->belongsTo(FoodCategory::class, 'parent_category');
    }
}
