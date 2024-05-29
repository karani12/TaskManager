<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialMediaLogin extends Controller
{
    public function showLoginMethod()
    {
        return inertia('LoginMethod');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    private function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect(route('login-method'));
        }

        $user = Socialite::driver('google')
            ->stateless()
            ->user();

        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {
            Auth::login($existingUser);
        } else {
            $newUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'avatar' => $user->getAvatar(),
                'password' => bcrypt(
                    $this->generateRandomString(10)

                )
            ]);

            Log::info('New User', ['newUser' => $newUser]);
            event(new Registered($newUser));
            Auth::login($newUser);
            return redirect(route('dashboard', absolute: false));
        }
        return redirect(route('dashboard', absolute: false));
    }
}
