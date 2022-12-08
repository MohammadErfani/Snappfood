<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['title','address','latitude','longitude','is_current'];
    protected $visible = ['id','title','address','latitude','longitude'];

    /**
     * Todo: Related to User and Restaurant
     * @return MorphTo
     */
    public function addressable():MorphTo
    {
        return $this->morphTo();
    }
}
