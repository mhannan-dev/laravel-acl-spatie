<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
    public function rules(User $user)
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|min:6',
            'password' => 'required'
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
