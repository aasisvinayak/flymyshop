<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
       "product_id",
        "title",
        "make",
        "category_id",
        "description",
        "details",
        "image",
        "price",
        "is_featured",
        "status"
    ];

}
