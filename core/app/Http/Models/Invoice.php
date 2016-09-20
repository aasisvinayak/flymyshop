<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['status'];

    /**
     * An invoice (order) belongs to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Each invoice has many invoice items (products purchased)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoice_items()
    {
        return $this->hasMany('App\Http\Models\InvoiceItem');
    }

    /**
     * Get all invoices by user
     * TODO: switch to relationship
     *
     * @param $query
     * @param $user_id
     * @return mixed
     */
    public function scopeByUser($query, $user_id)
    {
        return $query->select('*')
            ->where('user_id', '=', $user_id);
    }

    /**
     * Get invoice item by invoice_id
     *
     * @param $query
     * @param $slug
     * @return mixed
     */
    public function scopeGetID($query, $slug)
    {
        return $query->where('invoice_id', '=', $slug);
    }

    /**
     * Accessor to return invoice date in 'F d, Y' format
     *
     * @param $value
     * @return mixed
     */
    public function getCreatedAtAttribute($value)
    {
        return  date('F d, Y', strtotime($value));
    }

    /**
     * Show the new invoices first
     *
     * @param $query
     * @return mixed
     */
    public function scopeIdDescending($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    /**
     * Fetch sum of sub_total (sales) during a selected a period of time
     *
     * @param $query
     * @param $time
     * @return mixed
     */
    public function scopeSales($query, $time)
    {
        return $query->select('sub_total', 'created_at')
            ->where('created_at', '>', $time)->sum('sub_total');
    }

    /**
     * Select the number of invoices created after a specific time 
     *
     * @param $query
     * @param $time
     * @return mixed
     */
    public function scopeInvoiceCount($query, $time)
    {
        return $query->select('id')
            ->where('created_at', '>', $time)->count();
    }
}
