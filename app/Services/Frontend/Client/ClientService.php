<?php

namespace App\Services\Frontend\Client;

use App\Models\Client;
use App\Services\Base\Client\ClientService as ClientServiceBase;
use App\Services\Base\Client\Dto\ClientDto;

class ClientService extends ClientServiceBase
{
    /**
     * @param \App\Services\Base\Client\Dto\ClientDto $dto
     *
     * @return \App\Models\Client
     */
    public function create(ClientDto $dto): Client
    {
        //$client->sendEmailVerificationNotification();

        return parent::create($dto);
    }
}
