<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::when(request()->isMethod('POST'), Rule::unique(User::class)),
                Rule::when(request()->isMethod('PATCH'), Rule::unique(User::class)->ignore($this->user)),
            ],
            'role_id' => ['required', 'numeric', 'exists:roles,id'],
            'password' => [
                Rule::when(request()->isMethod('POST'), 'required'),
                'min:8',
                'confirmed'
            ]
        ];
    }
}
