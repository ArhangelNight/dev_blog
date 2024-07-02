<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'role' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Это поле необходимо заполнить',
            'name.string' => 'Имя должно быть строкой',
            'email.required' => 'Это поле необходимо заполнить',
            'email.string' => 'Почта должна быть строкой',
            'email.email' => 'Почта должна соответствовать формату mail@some.domain',
            'email.unique:users' => 'Этот эмэйл уже используется',
            'role.required' => 'Это поле необходимо заполнить',

        ];
    }
}
