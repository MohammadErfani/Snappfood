<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'percentage'];

//    protected function percentage():Attribute
//    {
//        return Attribute::make(
//            get: fn($value) => strval($value * 100) . '%'
//        );
//
//
//    }
}
