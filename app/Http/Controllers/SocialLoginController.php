<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirectToProvider($provider)
    {
        session()->put('url.intended', url()->previous());
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            abort(400, 'Invalid credentials provided.');
        }

        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {
            $this->updateExistingUser($existingUser, $provider, $user);
        } else {
            $this->createNewUser($user, $provider);
        }

        return redirect()->intended();
    }

    private function updateExistingUser(User $existingUser, $provider, \Laravel\Socialite\Contracts\User $user): void
    {
        if ($existingUser->provider != $provider || $existingUser->avatar != $user->getAvatar()) {
            $existingUser->provider = $provider;
            $existingUser->avatar = $user->getAvatar();
            $existingUser->save();
        }

        auth()->login($existingUser, true);
    }

    private function createNewUser(\Laravel\Socialite\Contracts\User $user, $provider): void
    {
        abort_if($user->getEmail() == null, 400, 'NULL Email ID provided by ' . $provider);
        abort_if($user->getName() == null, 400, 'NULL Name provided by ' . $provider);
        abort_if($user->getAvatar() == null, 400, 'NULL Avatar provided by ' . $provider);

        $newUser = new User();
        $newUser->name = $user->getName();
        $newUser->email = $user->getEmail();
        $newUser->email_verified_at = now();
        $newUser->password = '';
        $newUser->provider = $provider;
        $newUser->avatar = $user->getAvatar();
        $newUser->type = $user->getEmail() == env('ADMIN_EMAIL') ? 'admin' : 'registered';
        $newUser->save();

        auth()->login($newUser, true);
    }
}
