<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    const ADDED = 0;
    const ACCEPTED = 1;
    const DELETEREQUEST = 2;
    protected $fillable = ['order_id','score','content','answer','status'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->order->user();
    }

    public function restaurant()
    {
        return $this->order->restaurant();
    }
}
