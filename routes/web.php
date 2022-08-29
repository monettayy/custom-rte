<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Route::post('/login', [AuthController::class, 'login']);
Route::get('/login', [PageController::class, 'login'])->name('login');

Route::group(['middleware'=>'auth:sanctum'], function ($route) {
    $route->post('/logout', [AuthController::class, 'logout']);

    $route->get('/home', [PageController::class, 'home'])->name('home');

    $route->resource('/users', UserController::class);
    $route->get('/users-list', [UserController::class, 'list']);

    $route->prefix('/custom')->group(function($route){
        $route->get('/rte',[PageController::class, 'customRTE']);
    });
    
    $route->resource('/blogs', BlogController::class);
    $route->get('/blogs-list', [BlogController::class, 'list']);
});
