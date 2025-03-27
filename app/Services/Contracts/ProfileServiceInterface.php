<?php

namespace App\Services\Contracts;

use App\Http\Requests\Profile\ProfileUpdateRequest;

interface ProfileServiceInterface
{
    public function update(ProfileUpdateRequest $request): void;
}
