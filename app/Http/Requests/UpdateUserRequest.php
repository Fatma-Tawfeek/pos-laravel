<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required','string','max:255'],
            'email' => ['required','string', 'email', 'unique:users,email,'. $this->user->id],
            'password' => ['nullable','string','min:8', 'confirmed'],
            'role' => ['required', 'exists:roles,name'],
            'image' => ['nullable', 'image','mimes:jpeg,png,jpg','max:2048']
        ];
    }
}
