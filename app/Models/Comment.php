<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory,SoftDeletes;
    const ADDED = 0;
    const ACCEPTED = 1;
    const DELETEREQUEST = 2;
    protected $fillable = ['order_id','score','content','answer','status'];

    /**
     * @return BelongsTo
     */
    public function order():BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->order->user();
    }

    /**
     * @return mixed
     */
    public function restaurant()
    {
        return $this->order->restaurant();
    }
}
