<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            "title" => 'required',
            "make" => 'required',
            "category_id" => 'required',
            "description" => 'required',
            "details" => 'required',
            "image" => 'required',
            "price" => 'required',
            "is_featured" => 'required',

        ];
    }
}
