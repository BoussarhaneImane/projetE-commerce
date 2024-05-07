<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\DashboardController;
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
    return ['' => app()->version()];
   
});


Route::get('/example', function () {
    return 'Cette route utilise un middleware.';
})->middleware();
Route::get('/user/{user}', function ( $user) {
    return $user;
    });



require __DIR__.'/auth.php';
