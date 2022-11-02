<?php

namespace App\Models\admin;

use App\Models\restaurant\Food;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
    use HasFactory;
    protected $table='food_categories';

    public function foods()
    {
        return $this->belongsToMany(Food::class);
    }
}
