<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class DogApiService
{
    protected $endpoint = 'https://api.thedogapi.com/v1/images/search';

    public function getRandomDog()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-api-key' => 'live_QtkKvyYR92GGGDebSX6g5Sgl96jy874cDrSHlwAg9sLZJFpzcfGcZdXC9n47WAxR',
        ])->get($this->endpoint, [
            'size' => 'med',
            'mime_types' => 'jpg',
            'format' => 'json',
            'has_breeds' => true,
            'order' => 'RANDOM',
            'page' => 0,
            'limit' => 1
        ]);

        if ($response->successful() && count($response->json()) > 0) {
            return $response->json()[0];
        }

        return null;
    }
}
