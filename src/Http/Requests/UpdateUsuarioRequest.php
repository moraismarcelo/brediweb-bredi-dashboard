<?php

namespace Brediweb\BrediDashboard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsuarioRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|min:2',
            'email' => "required|email|unique:users,email,$this->id,id"
        ];

        if (request()->get('password'))
        {
            $rules = array_merge($rules, [
                'password' => config('bredidashboard.user.password_validation')
                ]
            );
        }

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
