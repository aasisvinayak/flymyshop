<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductImage
 * ProductImage model.
 */
class ProductImage extends Model
{
    protected $fillable = [
        'image_name',
        'image',
        'product_id',
    ];

    /**
     * Get product additional images
     * TODO: switch to relationship based - remove obsolete.
     *
     * @param $query
     * @param $product_id
     * @return mixed
     */
    public function scopeAdditionalImages($query, $product_id)
    {
        return $query->where('product_id', '=', $product_id);
    }

    /**
     * Each product image belongs to product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Http\Models\Product');
    }
}
