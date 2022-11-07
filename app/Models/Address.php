<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory,SoftDeletes;
/*
 * get all the owning of addressable models.
 */
    protected $fillable = ['title','address','latitude','longitude','is_current'];
    protected $visible = ['id','title','address','latitude','longitude'];
    public function addressable()
    {
        return $this->morphTo();
    }
}
