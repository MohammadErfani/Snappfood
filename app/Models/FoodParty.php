<?php

namespace App\Models;

use App\Models\admin\Discount;
use App\Models\restaurant\Food;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodParty extends Model
{
    use HasFactory;

    public function food()
    {
        $this->belongsTo(Food::class);
    }

    public function discount()
    {
        $this->belongsTo(Discount::class);
    }
}
