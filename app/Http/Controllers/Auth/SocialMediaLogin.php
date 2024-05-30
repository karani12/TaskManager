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
                $newUser = new User();
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->password = bcrypt($this->generateRandomString());
                $newUser->avatar = $user->avatar;
                $newUser->save();
                Auth::login($newUser, true);
                event(new Registered($newUser));

            }

            return redirect()->intended(route('dashboard', absolute: false));
        } catch (\Exception $e) {
            Log::error('Error', ['error' => $e->getMessage()]);
            return redirect(route('login', absolute: false));
        }


    }
}
