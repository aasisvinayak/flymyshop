<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PaymentCard
 * PaymentCard model to save user payment card
 *
 * @package App\Http\Models
 */
class PaymentCard extends Model
{
    protected $fillable = [

    ];

    /**
     * Each payment card belongs to a user
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get card object from card_id
     *
     * @param $query
     * @param $slug
     * @return mixed
     */
    public function scopeGetInfo($query, $slug)
    {
        return $query->where('card_id', '=', $slug)->get();
    }
}
