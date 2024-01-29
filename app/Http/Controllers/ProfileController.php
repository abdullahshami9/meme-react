<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Profile;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        if ($request->wantsJson()) {
            return response()->json(['status' => 200, 'message' => 'Updated successful']);
        }

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 200,
                'message' => 'you are logged out successfully',
                'data' => $user
            ]);
        }

        return Redirect::to('/');
    }

    public static function get_profile_pic($profile_id){
        // Define the file path
    $filePath = "app/public/pf_pic/{$profile_id}.'(.*)'";

    // Check if the file exists
    if (Storage::exists($filePath)) {
        // File exists, return the file URL
        $url = Storage::url($filePath);
        return $url;
    } else {
        // File doesn't exist, handle accordingly (return null, throw an exception, etc.)
        return null;
    }
    }


    public static function upload_profile_image(Request $request)
{
    $user = Auth::user();
    $profile = $user->profile;

    if ($request->hasFile("image") && $profile) {
        $image = $request->file("image");

        // Generate a unique filename based on the user ID
        $filename = $profile->id . '.' . $image->getClientOriginalExtension();

        // Specify the path where you want to save the image

        $storagePath = 'pf_pic/' . $filename;
        // $storagePath = 'media/' . $post_id.'.'.$mediaId . '.' . $extension; //for multiple images

        $image->storeAs('public', $storagePath);

        // $media->url = asset('storage/app/public/' . $storagePath);

        return response()->json([
            'status' => 200,
            'message' => 'Profile Picture Updated successfully',
            'data' => 'profile/' . $profile->id . '/' . $filename,
        ]);
    }

    return response()->json([
        'status' => 400,
        'message' => 'Invalid request or user not authenticated',
    ]);
}


    public function get_user_profile($id){
        $profile = Profile::select()
        ->where('id', $id)
        ->first();
        if (!$profile) {
            return new JsonResponse([
                'status' => 201,
                'message'=> 'Profile Not Fround'
            ]);
        }
        return $profile;
    }
}
