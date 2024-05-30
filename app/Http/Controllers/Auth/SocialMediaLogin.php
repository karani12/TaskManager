<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
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
            $user = Socialite::driver('google')
                ->stateless()
                ->user();
            $existingUser = User::where('email', $user->email)->first();
            if ($existingUser) {
                Auth::login($existingUser, true);
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => bcrypt($this->generateRandomString(10)),
                    'avatar' => $user->avatar
                ]);
                Auth::login($newUser, true);

            }

            return redirect()->intended(route('dashboard', absolute: false));
        } catch (\Exception $e) {
            Log::error('Error', ['error' => $e->getMessage()]);
            return redirect(route('login', absolute: false));
        }


    }
}
