<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('user/profile/data', [ProfileController::class, 'get_user_profile']);
Route::post('user/login', [AuthenticatedSessionController::class, 'store']);
Route::post('user/register', [RegisteredUserController::class, 'store']);
Route::post('user/logout', [ProfileController::class, 'destroy']);
Route::post('user/gender', [GenderController::class, 'get_gender']);
Route::post('user/profile/post', [PostController::class, 'create_post']);   
Route::post('user/profile/all-post', [PostController::class, 'fetch_post']);

Route::post('user/friend/search', [FriendController::class, 'search']);
Route::post('user/friend/request', [FriendController::class, 'send_hommy_request']);
Route::post('user/friend/friendlist', [FriendController::class, 'friendList']);
Route::post('user/friend/update', [FriendController::class, 'updateFriendRequest']);
Route::post('user/friend/friendlist-remove', [FriendController::class, 'deleteFriendRequest']);

Route::post('user/profile/add-reaction', [ReactionController::class,'add_reaction']);
Route::post('user/profile/get-reaction', [ReactionController::class,'get_reaction']);
Route::post('user/posts/{postId}/comments', [CommentController::class, 'getCommentsByPost']);
Route::post('user/posts/create-comments', [CommentController::class, 'createComment']);

// In routes/web.php
Route::middleware(['api', 'auth'])->group(function () {
    // Your routes here, including the one calling upload_profile_image 
    Route::post('user/profile-pic-upload', [ProfileController::class, 'upload_profile_image']);

});


// Route::post('user/profile-pic-upload', [ProfileController::class, 'upload_profile_image']);