<?php

namespace App\Service;

use App\Client\RandomUserClientInterface;

class UserService implements UserServiceInterface
{

    public function __construct(private readonly RandomUserClientInterface $client)
    {
    }

    public function getRandomUser(): array
    {
        return $this->client->getRandomUser();
    }
}
