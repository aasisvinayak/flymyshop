<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{

    protected $fillable=[
        'image_name',
        'image',
        'product_id'
    ];

    public function scopyAdditionalImages($query,$product_id)
    {
        return $query->where('product_id','=',$product_id);
    }

    public function product()
    {
        return $this->belongsTo('App\Http\Models\Product');
    }

}
