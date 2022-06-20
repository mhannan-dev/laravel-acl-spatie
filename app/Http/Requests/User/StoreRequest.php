<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreRequest extends FormRequest
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
            'name'    => 'required|min:3|max:100',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required',
            'type'        => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'Please enter name!',
            'email.required'        => 'Please enter email!',
            'password.required'     => 'Please enter password!',
            'type.required'         => 'Please select type!'
        ];
    }
}
