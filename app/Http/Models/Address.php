<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'address_l1',
        'address_l2',
        'city',
        'state',
        'country',
        'postcode',
    ];

    public function scopeGetInfo($query, $slug)
    {
        return $query->where('address_id', '=', $slug)->get();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
