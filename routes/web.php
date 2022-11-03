<?php

use App\Http\Controllers\TicketsController;
use App\Http\Controllers\UsersController;
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

Route::get('/', static function () {
   return redirect('/tickets');
});

Route::get('/tickets', [TicketsController::class, 'index']);

Route::get('/ticket/create', [TicketsController::class, 'create']);

Route::get('/ticket/{ticket}', [TicketsController::class, 'show']);

Route::post('ticket', [TicketsController::class, 'store']);

Route::get('/user/edit', [UsersController::class, 'edit']);


