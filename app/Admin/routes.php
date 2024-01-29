<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resource('user-memes', UserMemeController::class);
    $router->resource('posts', adminPostController::class);
    $router->resource('comments', adminCommentController::class);
    $router->resource('login-audits', admin_user_LoginAuditController::class);
    $router->resource('cities', adminCityController::class);
    

});
