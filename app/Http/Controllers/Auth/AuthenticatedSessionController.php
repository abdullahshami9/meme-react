<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\LoginAudit;
use App\Models\Profile;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);
    
    //     if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    //         $user = Auth::user();

    //         $profile = Profile::find($user->id);

    //         if ($request->wantsJson()) {
    //             return response()->json(['status' => 200, 'message' => 'Login successful', 'user' => $user, 'profile' => $profile]);
    //         } else {
    //             return redirect()->intended(RouteServiceProvider::HOME);
    //         }
    //     } else {
    //         if ($request->wantsJson()) {
    //             return response()->json(['message' => 'Login failed'], 401);
    //         } else {
    //             return back()->withInput()->withErrors(['email' => 'Invalid login credentials']);
    //         }
    //     }
    // }

    public function store(LoginRequest $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $credentials = ['email' => $request->email, 'password' => $request->password];

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $profile = Profile::find($user->id);

        // Log successful login attempt
        $this->logLoginAttempt('2', 'request->ip()', 'DummyLatitude', 'DummyLongitude');

        if ($request->wantsJson()) {
            return response()->json(['status' => 200, 'message' => 'Login successful', 'user' => $user, 'profile' => $profile]);
        } else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    } else {
        // Log failed login attempt
        $this->logFailedLoginAttempt($request->email, 'request->ip()', 'DummyLatitude', 'DummyLongitude');

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Login failed'], 401);
        } else {
            return back()->withInput()->withErrors(['email' => 'Invalid login credentials']);
        }
    }
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    private function logLoginAttempt($profile, $ip, $latitude, $longitude)
{
    LoginAudit::create([
        'profile_id_fk' => $profile,
        'login_at' => now(),
        'ip' => $ip,
        'latitude' => $latitude,
        'longitude' => $longitude,
        'is_login'=> 'true',
    ]);
}

private function logFailedLoginAttempt($email, $ip, $latitude, $longitude)
{
    LoginAudit::create([
        'profile_id_fk' => null, // Dummy value for failed login attempt
        'login_at' => now(),
        'ip' => $ip,
        'latitude' => $latitude,
        'longitude' => $longitude,
        'email' => $email,
        'is_login' => 'false',
    ]);
}

}
