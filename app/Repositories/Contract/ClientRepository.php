<?php

namespace App\Repositories\Contract;

use App\Models\Client;
use App\Services\Base\Client\Dto\ClientDto;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface ClientRepositoryInterface.
 */
interface ClientRepository
{
    /**
     * @param \App\Services\Base\Client\Dto\ClientDto $dto
     *
     * @return \App\Models\Client
     */
    public function create(ClientDto $dto): Client;

    /**
     * @param \App\Models\Client                      $client
     * @param \App\Services\Base\Client\Dto\ClientDto $dto
     *
     * @return \App\Models\Client
     */
    public function update(Client $client, ClientDto $dto): Client;

    /**
     * @param \App\Models\Client $client
     *
     * @return void
     */
    public function delete(Client $client): void;

    /**
     * @param string $id
     *
     * @return \App\Models\Client
     */
    public function getById(string $id): Client;

    /**
     * @param int  $paginate
     * @param bool $withTrashed
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $paginate, bool $withTrashed = false): LengthAwarePaginator;
}
