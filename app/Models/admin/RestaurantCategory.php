<?php

namespace App\Models\admin;

use App\Models\restaurant\Restaurant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantCategory extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name','picture','parent_category'];
    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class);
    }
}
