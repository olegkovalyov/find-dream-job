<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\ProfileUpdateRequest;
use App\Services\Contracts\ProfileServiceInterface;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    public function __construct(
        private readonly ProfileServiceInterface $profileService
    ) {
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $this->profileService->update($request);
        return redirect()->route('dashboard.index')->with('success', 'Profile info updated!');
    }
}
