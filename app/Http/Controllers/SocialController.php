<?php

namespace App\Http\Controllers;

use App\User;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Http\Request;
use Auth;

class SocialController extends Controller
{
    function LoginWithGithub(){
        return Socialite::driver('github')->redirect();
    }
    function GithubCallBack(){
        $user = Socialite::driver('github')->user();
        if (User::where('email', $user->getEmail())->exists()) {
            $get_user = User::where('email', $user->getEmail())->first();
            Auth::guard()->login($get_user, true);
            return redirect()->to('/home');
        }else {
            $create_user = User::create([
                'name'          => $user->getName(),
                'email'         => $user->getEmail(),
                'provider'      => 'github',
                'provider_id'   => $user->getId(),
            ]);
            // return $create_user;
            Auth::guard()->login($create_user, true);
            return redirect()->to('/home');
        }

        // echo $user->getId();
        // echo $user->getNickname();
        // echo $user->getName();
        // echo $user->getEmail();
        // echo $user->getAvatar();

    }
    function LoginWithGoogle(){
        return Socialite::driver('google')->redirect();
    }
    function GoogleCallBack(){
        $user = Socialite::driver('google')->user();
        if (User::where('email', $user->getEmail())->exists()) {
            $get_user = User::where('email', $user->getEmail())->first();
            Auth::guard()->login($get_user, true);
            return redirect()->to('/home');
        }else {
            $create_user = User::create([
                'name'          => $user->getName(),
                'email'         => $user->getEmail(),
                'provider'      => 'google',
                'provider_id'   => $user->getId(),
            ]);
            // return $create_user;
            Auth::guard()->login($create_user, true);
            return redirect()->to('/home');
        }

        // echo $user->getId();
        // echo $user->getNickname();
        // echo $user->getName();
        // echo $user->getEmail();
        // echo $user->getAvatar();

    }
}
