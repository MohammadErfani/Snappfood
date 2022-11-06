<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
/*
 * get all the owning of addressable models.
 */
    protected $fillable = ['address','latitude','longitude'];
    public function addressable()
    {
        return $this->morphTo();
    }
}
