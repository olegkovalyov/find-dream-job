<?php

namespace App\Services\Concrete;

use App\Http\Requests\Profile\ProfileUpdateRequest;
use App\Models\User;
use App\Services\Contracts\ProfileServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileService implements ProfileServiceInterface
{

    public function update(ProfileUpdateRequest $request): void
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user) {
            return;
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('local')->delete('avatars/'.$user->avatar);
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = basename($avatarPath);
        }
        $user->save();
    }
}
