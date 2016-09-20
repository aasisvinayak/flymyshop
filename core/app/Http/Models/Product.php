<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function getPriceAttribute($value)
    {
        $currencyValue = env('CURRENCY_SYMBOL');

        if (session('shop_currency')) {
            $currencyValue = session('shop_currency');
        }

        return  currency($value, $currencyValue);
    }

    public function scopeByCategory($query, $category_id)
    {
        return $query->select('product_id', 'id', 'make',
            'title', 'price', 'image_name', 'description')
            ->where('category_id', '=', $category_id);
    }

    public function scopeGetID($query, $slug)
    {
        return $query->where('product_id', '=', $slug);
    }

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

    public function scopePublishedProducts($query, $take, $skip)
    {
        return $query->select('product_id', 'id',
            'title', 'price', 'image_name', 'description')
            ->take(10)->skip(0)
            ->where('status', '=', '1')
            ->orderBy('id', 'DESC')->get();
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'LIKE', '%'.$search.'%')
            ->orWhere('make', 'LIKE', '%'.$search.'%')
            ->orWhere('description', 'LIKE', '%'.$search.'%')
            ->orWhere('details', 'LIKE', '%'.$search.'%')
            ->get();
    }

    public function scopePriceFromProductID($query, $product_id)
    {
        return $query->select('price')
            ->where('product_id', '=', $product_id);
    }

    public function scopeProductSummaryProductID($query, $product_id)
    {
        return $query->select('id', 'title', 'price', 'image_name', 'description')
            ->where('product_id', '=', $product_id);
    }

    public function category()
    {
        return $this->belongsTo('App\Http\Models\Category');
    }

    public function additionalImages()
    {
        return $this->hasMany('App\Http\Models\ProductImage');
    }
}
