<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\listFriendsController;
use App\Http\Controllers\messageController;

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
    return ['Laravel' => app()->version()];
});
Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('v1')->group(function (){
        Route::resource('users', userController::class);
        // TODO: Users route
        Route::get('friends', [listFriendsController::class, 'index']);
        // TODO: Message route
        Route::prefix('message')->group(function (){
            Route::get('{id}', [messageController::class, 'getMessage']);
            Route::post('/', [messageController::class, 'postMessage']);
        });
    });
});
require __DIR__.'/auth.php';
