<?php

use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\LoginController;
use App\Http\Controllers\Api\Admin\MenuController;
use App\Http\Controllers\Api\Admin\PostController;
use App\Http\Controllers\Api\Admin\SliderController;
use App\Http\Controllers\Api\Admin\TagController;
use App\Http\Controllers\Api\Admin\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//group route with prefix "admin"
Route::prefix('v1/admin')->group(function () {

    //route login
    Route::post('/login', [LoginController::class, 'index']);

    //group route with middleware "auth"
    Route::group(['middleware' => 'auth:api'], function () {

        //data user
        Route::get('/user', [LoginController::class, 'getUser']);

        //refresh token JWT
        Route::get('/refresh', [LoginController::class, 'refreshToken']);

        //logout
        Route::post('/logout', [LoginController::class, 'logout']);

        //Tags
        Route::apiResource('/tags', TagController::class);

        //Category
        Route::apiResource('/categories', CategoryController::class);

        //Poss
        Route::apiResource('/posts', PostController::class);

        //Menus
        Route::apiResource('/menus', MenuController::class);

        //Sliders
        Route::apiResource('/sliders', SliderController::class);

        //Users
        Route::apiResource('/users', UserController::class);

        //dashboard
        Route::get('/dashboard', [DashboardController::class, 'index']);
    });
});

//group route with prefix "web"
Route::prefix('v1/web')->group(function () {

    //index tags
    Route::get('/tags', [App\Http\Controllers\Api\Web\TagController::class, 'index']);

    //show tag
    Route::get('/tags/{slug}', [App\Http\Controllers\Api\Web\TagController::class, 'show']);
    //index categories
    Route::get('/categories', [App\Http\Controllers\Api\Web\CategoryController::class, 'index']);

    //show category
    Route::get('/categories/{slug}', [App\Http\Controllers\Api\Web\CategoryController::class, 'show']);

    //categories sidebar
    Route::get('/categorySidebar', [App\Http\Controllers\Api\Web\CategoryController::class, 'categorySidebar']);

    //index posts
    Route::get('/posts', [App\Http\Controllers\Api\Web\PostController::class, 'index']);

    //show posts
    Route::get('/posts/{slug}', [App\Http\Controllers\Api\Web\PostController::class, 'show']);

    //posts homepage
    Route::get('/postHomepage', [App\Http\Controllers\Api\Web\PostController::class, 'postHomepage']);

    //store comment
    Route::post('/posts/storeComment', [App\Http\Controllers\Api\Web\PostController::class, 'storeComment']);

    //store image
    Route::post('/posts/storeImage', [App\Http\Controllers\Api\Web\PostController::class, 'storeImagePost']);

    //index menus
    Route::get('/menus', [App\Http\Controllers\Api\Web\MenuController::class, 'index']);

    //index sliders
    Route::get('/sliders', [App\Http\Controllers\Api\Web\SliderController::class, 'index']);
});
