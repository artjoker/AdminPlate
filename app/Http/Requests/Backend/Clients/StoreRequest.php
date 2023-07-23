<?php

namespace App\Http\Requests\Backend\Clients;

use App\Services\Base\Client\Dto\ClientDto;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreRequest.
 */
class StoreRequest extends FormRequest
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
        /** @phpstan-ignore-next-line  */
        $clientId = optional($this->route('client'))->id;
        $client   = $clientId ?: 'NULL';

        return [
            'first_name' => [
                'required',
                'max:255',
            ],
            'last_name'  => [
                'nullable',
                'max:255',
            ],
            'email'      => [
                'required',
                'email',
                'unique:clients,email,' . $client
                . ',id,deleted_at,NULL',
            ],
            'phone'      => [
                'nullable',
                'max:30',
                'unique:clients,phone,' . $client
                . ',id,deleted_at,NULL',
            ],
            'password'   => [
                'nullable',
                'min:6',
            ],
            'active'     => [
                'bool',
            ],
        ];
    }

    public function getDto(): ClientDto
    {
        /** @phpstan-ignore-next-line  */
        return new ClientDto(...$this->validated());
    }
}
