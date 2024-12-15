<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\Auth\SendPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

final class OAuthService
{
    public function auth(string $driver): void
    {
        try {
            $oauthUser = Socialite::driver($driver)->user();
            $user = User::where('email', $oauthUser->email)->first();

            if ($user) {
                Auth::login($user);

                notyf()->success('Logged in successfully');
            } else {
                $password = Str::password(16, symbols: false);

                $avatar = file_get_contents($oauthUser->getAvatar());
                $avatarName = $oauthUser->getId().'.jpg';
                \Storage::drive('avatars')->put($avatarName, $avatar);

                $newUser = User::create([
                    'avatar'   => $avatarName,
                    'username' => $oauthUser->name,
                    'email'    => $oauthUser->email,
                    'password' => bcrypt($password),
                ]);

                Auth::login($newUser);

                $newUser->notify(new SendPassword($password));

                notyf()->success('Registered successfully');
            }
        } catch (\Throwable $e) {
            notyf()->error('Error occurred while authenticating, please try again');
        }
    }
}
