<?php

namespace App\Models\admin;

use App\Models\restaurant\Restaurant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name','picture','parent_id'];
    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class);
    }
}
