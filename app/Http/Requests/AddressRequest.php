<?php

namespace App\Http\Requests;

class AddressRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //TODO change this to check for auth/permission: Right now it
        //is being enforced using policies
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
            'address_l1'      => 'required',
            'address_l2'      => 'required',
            'city'            => 'required',
            'state'           => 'required',
            'country'         => 'required',
            'postcode'        => 'required',
        ];
    }
}
