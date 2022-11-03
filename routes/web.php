<?php

use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
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

Route::get('/tickets', [TicketController::class, 'index']);

Route::get('/ticket/create', [TicketController::class, 'create']);

Route::get('/ticket/{ticket}', [TicketController::class, 'show']);

Route::post('ticket', [TicketController::class, 'store']);

Route::get('/user/edit', [UserController::class, 'edit']);


