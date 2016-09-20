<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InvoiceItem
 * Model for individual items.
 */
class InvoiceItem extends Model
{
    /**
     * TODO: remove unused method.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function invoice()
    {
        return $this->belongsTo('App\Http\Models\Invoice');
    }

    /**
     * Fetch number of products sold after $time.
     *
     * @param $query
     * @param $time
     * @return mixed
     */
    public function scopeProductsSold($query, $time)
    {
        return $query->select('qty', 'created_at')
            ->where('created_at', '>', $time)->sum('qty');
    }
}
