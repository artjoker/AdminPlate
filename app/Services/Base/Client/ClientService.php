<?php

namespace App\Services\Base\Client;

use App\Models\Client;
use App\Repositories\Contract\ClientRepository;
use App\Services\Base\Client\Dto\ClientDto;

class ClientService
{
    /**
     * @param \App\Repositories\Contract\ClientRepository $clientRepository
     */
    public function __construct(
        protected ClientRepository $clientRepository
    ) {
    }

    /**
     * @param \App\Services\Base\Client\Dto\ClientDto $dto
     *
     * @return \App\Models\Client
     */
    public function create(ClientDto $dto): Client
    {
        return $this->clientRepository->create($dto);
    }

    /**
     * @param string                                  $id
     * @param \App\Services\Base\Client\Dto\ClientDto $dto
     *
     * @return \App\Models\Client
     */
    public function update(string $id, ClientDto $dto): Client
    {
        $client = $this->clientRepository->getById($id);

        return $this->clientRepository->update($client, $dto);
    }
}
