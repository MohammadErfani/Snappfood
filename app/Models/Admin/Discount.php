<?php

namespace App\Models\Admin;

use App\Models\FoodParty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'percentage'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function foodParties():HasMany
    {
        return $this->hasMany(FoodParty::class);
    }
//    protected function percentage():Attribute
//    {
//        return Attribute::make(
//            get: fn($value) => strval($value * 100) . '%'
//        );
//
//
//    }
}
