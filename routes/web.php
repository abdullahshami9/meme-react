<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/auth/{provider}/redirect', [LoginController::class, 'redirect']);

Route::get('/auth/{provider}/callback', [LoginController::class, 'callback'])->middleware('web');


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/media/{filename}', function ($filename) {
    $path = storage_path('app/public/media/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->where('filename', '(.*)');


Route::get('/profile/{filename}', function ($filename) {
    $path = storage_path('app/public/pf_pic/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->where('filename', '(.*)');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile-user',function(){
        return Inertia::render('Profile/UserProfile');
    })->name('profile.user');
});

require __DIR__.'/auth.php';
