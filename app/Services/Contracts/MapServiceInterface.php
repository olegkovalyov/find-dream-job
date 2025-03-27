<?php

namespace App\Services\Contracts;

interface MapServiceInterface
{
    public function getDataByAddress(string $address): array;
}
