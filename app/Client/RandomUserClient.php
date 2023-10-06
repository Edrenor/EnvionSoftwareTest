<?php

namespace App\Client;

use Illuminate\Support\Facades\Http;
class RandomUserClient implements RandomUserClientInterface
{
    public function getRandomUser(): ?array
    {
        $response = Http::get('https://randomuser.me/api/');

        if ($response->status() == 200) {
            $data = json_decode($response->body(), true);

            if (isset($data['results'][0])) {
                return $data['results'][0];
            }
        }

        return null;
    }
}
