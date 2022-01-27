<?php

namespace App\Http\Controllers;

use App\Mail\UserAfterRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function heandleProviderCallback()
    {
        // return 'Ok';
        $callback = Socialite::driver('google')->stateless()->user();

        $data = [
            'name'                  => $callback->getName(),
            'email'                 => $callback->getEmail(),
            'avatar'                => $callback->getAvatar(),
            'email_verified_at'     => now(),
        ];

        // $user = User::firstOrCreate(['email' => $data['email']], $data);
        $user = User::whereEmail($data['email'])->first();
        if (!$user) {
            $user = User::create($data);
            Mail::to($user->email)->send(new UserAfterRegister($user));
        }
        Auth::login($user, true);

        return redirect()->route('dashboard');
    }
}
