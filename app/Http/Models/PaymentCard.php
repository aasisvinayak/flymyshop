<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentCard extends Model
{
    protected $fillable=[

    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
