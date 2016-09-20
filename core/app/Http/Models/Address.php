<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Address
 * Address model to store user's address information
 *
 * @package App\Http\Models
 */
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

    /**
     * Get address object from address_id
     *
     * @param $query
     * @param $slug
     * @return mixed
     */
    public function scopeGetInfo($query, $slug)
    {
        return $query->where('address_id', '=', $slug)->get();
    }

    /**
     * Each address belong to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
