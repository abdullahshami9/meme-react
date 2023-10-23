<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {

        // $user = Socialite::driver($provider)->user();
        try {
            //code...
            // $SocialUser = Socialite::driver($provider)->stateless()->user();
            $SocialUser = Socialite::driver($provider)->user();
            $user = User::where("email", $SocialUser->email)->first();
            if (User::where('email', $SocialUser->getEmail())->exists()) {
                // return redirect('/login')->withErrors(['email' => 'This email uses different method to login.']);
                $user = User::where([
                    'email' => $SocialUser->getEmail()
                ])->first();

                Auth::login($user);
                return redirect('/dashboard');
            } else {
                // $user = User::where([
                //     'provider' => $provider,
                //     'provider_id' => $SocialUser->id
                //     ])->first();
                if (!$user) {

                    $user = new User;
                    $user->name = $SocialUser->name;
                    $user->email = $SocialUser->email;
                    $user->username = User::generateUserName($SocialUser->nickname);
                    $user->provider = $provider;
                    $user->provider_id = $SocialUser->id;
                    $user->provider_token = $SocialUser->token;
                    $user->email_verified_at = now();
                    $user->save();

                    $user = User::updateOrCreate([
                        'provider_id' => $SocialUser->id,
                        'provider' => $provider
                    ], [
                        'name' => $SocialUser->name,
                        'username' => User::generateUserName($SocialUser->nickname),
                        'email' => $SocialUser->email,
                        'provider_token' => $SocialUser->token,
                        'provider_refresh_token' => $SocialUser->refreshToken,
                    ]);

                    Auth::login($user);

                    return redirect('/dashboard');
                }
            }
        } catch (\Exception $e) {
            //throw $th;
            return redirect('/login');
        }


    }

    public function userdata()
    {
        $allUser = User::select()
            ->get();
        return $allUser;
    }
}