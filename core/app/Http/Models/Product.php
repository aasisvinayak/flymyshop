<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * Product model.
 */
class Product extends Model
{
    protected $fillable = [
       'product_id',
        'title',
        'make',
        'category_id',
        'description',
        'details',
        'image',
        'image_name',
        'price',
        'is_featured',
        'status',
        'stock',
    ];

    /**
     * Accessor for price based on env config.
     *
     * @param $value
     * @return mixed
     */
    public function getPriceAttribute($value)
    {
        $currencyValue = env('CURRENCY_SYMBOL');
        if (session('shop_currency')) {
            $currencyValue = session('shop_currency');
        }

        return  currency($value, $currencyValue);
    }

    /**
     * Get products by category_id
     * TODO: Switch to relationship based fetching.
     *
     * @param $query
     * @param $category_id
     * @return mixed
     */
    public function scopeByCategory($query, $category_id)
    {
        return $query->select('product_id', 'id', 'make',
            'title', 'price', 'image_name', 'description')
            ->where('category_id', '=', $category_id);
    }

    /**
     * Get product using product_id.
     *
     * @param $query
     * @param $slug
     * @return mixed
     */
    public function scopeGetID($query, $slug)
    {
        return $query->where('product_id', '=', $slug);
    }

    /**
     * Returns latest 9 featured products.
     *
     * @param $query
     * @return mixed
     */
    public function scopeFeatured($query)
    {
        return $query->select('product_id', 'id',
            'title', 'price', 'image_name', 'description')
            ->where('is_featured', '=', '1')
            ->where('status', '=', '1')
            ->orderBy('id', 'DESC')->take(9)->skip(0)->get();
    }

    public function scopePublished($query)
    {
        return $query->select('product_id', 'id',
            'title', 'price', 'image_name', 'description')
            ->where('status', '=', '1')
            ->orderBy('id', 'DESC')->skip(0)->get();
    }

    /**
     * Returns featured products based on limit().
     *
     * @param $query
     * @param $take
     * @param $skip
     * @return mixed
     */
    public function scopePublishedProducts($query, $take, $skip)
    {
        return $query->select(
            'product_id',
            'id',
            'title',
            'price',
            'image_name',
            'description'
        )
            ->take(10)->skip(0)
            ->where('status', '=', '1')
            ->orderBy('id', 'DESC')->get();
    }

    /**
     * Fetch search results for products
     * search by product title, make, description or details.
     *
     * @param $query
     * @param $search
     * @return mixed
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'LIKE', '%'.$search.'%')
            ->orWhere('make', 'LIKE', '%'.$search.'%')
            ->orWhere('description', 'LIKE', '%'.$search.'%')
            ->orWhere('details', 'LIKE', '%'.$search.'%')
            ->get();
    }

    /**
     * Get price of the product from product_id.
     *
     * @param $query
     * @param $product_id
     * @return mixed
     */
    public function scopePriceFromProductID($query, $product_id)
    {
        return $query->select('price')
            ->where('product_id', '=', $product_id);
    }

    /**
     * Get product details from product_id.
     *
     * @param $query
     * @param $product_id
     * @return mixed
     */
    public function scopeProductSummaryProductID($query, $product_id)
    {
        return $query->select('id', 'title', 'price', 'image_name', 'description')
            ->where('product_id', '=', $product_id);
    }

    /**
     * Product belong a category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Http\Models\Category');
    }

    /**
     * A product has many product images.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function additionalImages()
    {
        return $this->hasMany('App\Http\Models\ProductImage');
    }
}
