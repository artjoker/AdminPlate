<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SettingsRequest.
 */
class SettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'key' => [
                'max:100',
                'regex:/[\w\d-_]*/i',
                'unique:settings,key' . ($this->isMethod('put') ? ',' . request()->global . ',key' : ''),
                'required',
            ],
        ];
    }
}
