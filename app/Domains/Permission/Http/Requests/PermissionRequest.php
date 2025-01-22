<?php

namespace App\Domains\Permission\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|string|max:255|unique:permissions,name',
            'description' => 'nullable|string',
            'groups' => 'sometimes|array',
            'groups.*' => 'exists:groups,id',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'The permission name must be unique.',
            'groups.*.exists' => 'One or more groups do not exist.',
        ];
    }
}