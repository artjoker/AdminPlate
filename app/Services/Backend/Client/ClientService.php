<?php

namespace App\Services\Backend\Client;

use App\Services\Base\Client\ClientService as ClientServiceBase;

class ClientService extends ClientServiceBase
{
    /**
     * @param string $id
     *
     * @return void
     */
    public function restore(string $id): void
    {
        $client = $this->clientRepository->getById($id);

        $client->restore();
    }

    /**
     * @param string $id
     *
     * @return void
     */
    public function delete(string $id): void
    {
        $client = $this->clientRepository->getById($id);
        $this->clientRepository->delete($client);
    }
}
