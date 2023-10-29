<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    //: RedirectResponse
    {
        $data = [];
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $status = 1; //active approved
        $privacy = 1; //pubilc
        $city = 1; //by default city is karachi but we've to set dynamically

        $profile = new Profile;
        $profile->user_id_fk = $user->id;
        $profile->username = $request->name;
        $profile->fullname = $request->name;
        $profile->gender_id_fk = 1;
        // $profile->gender_id_fk = $request->gender_id;
        $profile->status_id_fk = $status;
        $profile->privacy_id_fk = $privacy;
        $profile->city_id_fk = $city;
        $profile->created_at = now();

        if($profile->save()){
            $data['profile'] = [
                'id' => $profile->id,
                'name' => $profile->username,
                'profile_image' => $profile->profile_img_url
            ];
        }

        event(new Registered($user));

        Auth::login($user);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Registration successful', 'user' => $user, 'profile' => $data], 200);
        } else {
            return redirect(RouteServiceProvider::HOME);
        }
    }
}
