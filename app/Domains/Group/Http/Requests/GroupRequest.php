<?php

namespace App\Domains\Group\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|string|max:255',
            'permissions' => 'sometimes|array',
            'permissions.*' => 'exists:permissions,id',
            'users' => 'sometimes|array',
            'users.*' => 'exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'permissions.*.exists' => 'One or more permissions do not exist.',
            'users.*.exists' => 'One or more users do not exist.',
        ];
    }
}