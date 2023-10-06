<?php

namespace App\Client;

interface RandomUserClientInterface
{
    public function getRandomUser(): ?array;
}
