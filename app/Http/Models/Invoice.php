<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable=['status'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function invoice_items()
    {
        return $this->hasMany('App\Http\Models\InvoiceItem');
    }

    public function scopeByUser($query, $user_id)
    {
        return $query->select('*')
            ->where('user_id', '=', $user_id);
    }

    public function scopeGetID($query, $slug)
    {
        return $query->where('invoice_id', '=', $slug);
    }

    public function getCreatedAtAttribute($value)
    {
        return  date('F d, Y', strtotime($value));
    }

    public function scopeIdDescending($query)
    {
        return $query->orderBy('id', 'DESC');
    }
}
