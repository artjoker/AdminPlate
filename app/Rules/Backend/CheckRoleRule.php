<?php

namespace App\Rules\Backend;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckRoleRule implements ValidationRule
{
    /**
     * @var array<int, string>
     */
    public array $roles = [];
    /**
     * @var string
     */
    public string $username;

    /**
     * Create a new rule instance.
     *
     * CheckRoleRule constructor.
     *
     * @param string $username
     */
    public function __construct(string $username = 'email')
    {
        $this->username = $username;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return __('backend.user_not_found');
    }

    public function validate(
        string $attribute,
        mixed $value,
        Closure $fail
    ): void {
        if (is_null(User::where($this->username, $value))) {
            $fail($this->message());
        }
    }
}
