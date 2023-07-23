<?php

namespace App\Http\Requests\Backend\Users;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdatePassRequest.
 */
class UpdatePassRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @return string
     */
    public function getUserIdentityRules(): string
    {
        /* @phpstan-ignore-next-line  */
        return strpos(request()?->get('user_identity'), '@')
            ? 'required|max:30|email|exists:users,email'
            : 'required|max:30|exists:users,phone';
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @return string
     */
    public static function getUserIdentityField(): string
    {
        /* @phpstan-ignore-next-line  */
        return strpos(request()?->get('user_identity'), '@')
            ? 'email'
            : 'phone';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'user_identity'             => $this->getUserIdentityRules(),
            'new_password'              => 'required|min:5|max:20',
            'new_password_confirmation' => 'required|min:5|max:20|in:' . request()->new_password,
        ];
    }
}
