<?php

namespace App\Services\Concrete;

use App\Services\Contracts\MapServiceInterface;
use Illuminate\Support\Facades\Http;

class MapService implements MapServiceInterface
{
    public function getDataByAddress(string $address): array
    {
        $accessToken = env('MAPBOX_API_KEY');
        $response = Http::get("https://api.mapbox.com/geocoding/v5/mapbox.places/{$address}.json", [
            'access_token' => $accessToken
        ]);
        return $response->json();
    }
}
