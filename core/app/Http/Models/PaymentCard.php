<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentCard extends Model
{
    protected $fillable = [

    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeGetInfo($query, $slug)
    {
        return $query->where('card_id', '=', $slug)->get();
    }
}
