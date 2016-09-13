<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Http\Models\Invoice');
    }

    public function scopeProductsSold($query, $time)
    {
        return $query->select('qty', 'created_at')
            ->where('created_at', '>', $time)->sum('qty');
    }
}
