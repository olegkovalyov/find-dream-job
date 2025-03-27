<?php

namespace App\Http\Controllers;

use App\Services\Contracts\MapServiceInterface;
use Illuminate\Http\Request;

class GeocodeController extends Controller
{
    public function __construct(
        private readonly MapServiceInterface $mapService
    ) {
    }

    public function geocode(Request $request): array
    {
        $address = $request->input('address');
        $result = $this->mapService->getDataByAddress($address);
        return $result;
    }
}
