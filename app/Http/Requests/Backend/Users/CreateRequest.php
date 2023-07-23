<?php

namespace App\Http\Requests\Backend\Users;

use App\Services\Base\User\Dto\UserDto;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateRequest.
 */
class CreateRequest extends FormRequest
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
        /** @phpstan-ignore-next-line */
        $user = optional(request()->user)->id ?: 'NULL';

        return [
            'name'     => [
                'required',
                'max:255',
            ],
            'email'    => [
                'required',
                'max:30',
                'email',
                'unique:users,email,' . $user . ',id,deleted_at,NULL',
            ],
            'phone'    => [
                'required',
                'max:30',
                'unique:users,phone,' . $user . ',id,deleted_at,NULL',
            ],
            'password' => [
                'required',
                'min:6',
                'max:20',
            ],
            'role'     => [
                'required',
                'exists:roles,id',
            ],
            'active'   => [
                'bool',
            ],
        ];
    }

    /**
     * @return \App\Services\Base\User\Dto\UserDto
     */
    public function getDto(): UserDto
    {
        /** @phpstan-ignore-next-line  */
        return new UserDto(...$this->validated());
    }
}
