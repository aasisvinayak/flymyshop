<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class InstallRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //TODO: include logic here
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
            'SHOP_NAME'       => 'required',
            'DB_HOST'        => 'required',
            'DB_PORT'      => 'required',
            'DB_USERNAME'      => 'required',
            'DB_PASSWORD'      => 'required',
            'DB_DATABASE'      => 'required',
        ];
    }
}
