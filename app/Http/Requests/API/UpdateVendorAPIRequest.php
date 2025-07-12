<?php

namespace App\Http\Requests\API;

use App\Models\Vendor;
use InfyOm\Generator\Request\APIRequest;

class UpdateVendorAPIRequest extends APIRequest
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
        $rules = Vendor::$rules;

        // Ignore the current vendor's email when checking for uniqueness
        if ($this->route('vendor')) {
            $rules['email'] = 'required|email|unique:vendors,email,' . $this->route('vendor');
        }

        return $rules;
    }
}
