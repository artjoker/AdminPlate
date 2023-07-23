<?php

namespace App\Repositories\Clients;

use App\Models\Client;
use App\Repositories\Contract\ClientRepository;
use App\Services\Base\Client\Dto\ClientDto;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

/**
 * Class ClientRepository.
 */
class ClientEloquentRepository implements ClientRepository
{
    /**
     * @param \App\Services\Base\Client\Dto\ClientDto $dto
     *
     * @return \App\Models\Client
     */
    public function create(ClientDto $dto): Client
    {
        $client = new Client();

        $client->password   = bcrypt($dto->getPassword() ?: Str::password(6));
        $client->last_name  = $dto->getLastName();
        $client->first_name = $dto->getFirstName();
        $client->email      = $dto->getEmail();
        $client->phone      = $dto->getPhone();
        $client->active     = $dto->isActive();

        $client->save();

        return $client;
    }

    /**
     * @param \App\Models\Client                      $client
     * @param \App\Services\Base\Client\Dto\ClientDto $dto
     *
     * @return \App\Models\Client
     */
    public function update(Client $client, ClientDto $dto): Client
    {
        if ($dto->getPassword()) {
            $client->password = bcrypt($dto->getPassword());
        }

        $client->last_name  = $dto->getLastName();
        $client->first_name = $dto->getFirstName();
        $client->email      = $dto->getEmail();
        $client->phone      = $dto->getPhone();
        $client->active     = $dto->isActive();

        $client->save();

        return $client;
    }

    /**
     * @param \App\Models\Client $client
     *
     * @return void
     */
    public function delete(Client $client): void
    {
        if (! $client->trashed()) {
            $client->active = false;
            $client->save();
        }

        $client->delete();
    }

    /**
     * @param string $id
     *
     * @return \App\Models\Client
     */
    public function getById(string $id): Client
    {
        /** @var Client $client */
        $client = Client::query()
            ->where('id', '=', $id)
            ->first();

        if (! $client) {
            abort(404, 'Client not found');
        }

        return $client;
    }

    /**
     * @param int  $paginate
     * @param bool $withTrashed
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $paginate, bool $withTrashed = false): LengthAwarePaginator
    {
        $client = Client::query();

        if ($withTrashed) {
            $client = $client->withTrashed();
        }

        return $client->paginate($paginate);
    }
}
