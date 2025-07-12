<?php

namespace App\Http\Requests\API;

use App\Models\User;
use InfyOm\Generator\Request\APIRequest;

class UpdateUserAPIRequest extends APIRequest
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
        $rules = User::$rules;
        
        // Make password optional for updates, but validate if provided
        $rules['password'] = 'nullable|string|min:8|confirmed';

        // Ignore the current user's email when checking for uniqueness
        if ($this->route('user')) {
            $rules['email'] = 'required|email|unique:users,email,' . $this->route('user');
        }

        return $rules;
    }
}
