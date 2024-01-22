<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\UsersService;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class RandomUserApiService implements UsersService
{
    const DEFAULT_METHOD = 'GET';
    const URL = 'https://randomuser.me/api/';
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @throws GuzzleException
     */
    public function getUser(): User
    {
        $response = $this->client->request(self::DEFAULT_METHOD, self::URL);

        if ($response->getStatusCode() === 200) {
            $decoded = json_decode($response->getBody()->getContents(), associative: true);

            if (isset($decoded['results'])) {
                $info = $decoded['results'][0];

                return new User(
                    firstName: $info['name']['first'],
                    lastName: $info['name']['last'],
                    phone: $info['phone'],
                    email: $info['email'],
                    country: $info['location']['country']
                );
            }
        }

        abort(500, 'Error occurred while fetching data from the API');
    }
}
