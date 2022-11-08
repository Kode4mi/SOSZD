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

// Redirect z '/' do '/login'

Route::get('/', static function () {
   return redirect('login');
});

// Ticket

Route::get('tickets', [TicketController::class, 'index'])->middleware('auth');

Route::get('ticket/create', [TicketController::class, 'create'])->middleware('auth');

Route::get('ticket/{ticket}', [TicketController::class, 'show'])->middleware('auth');

Route::post('ticket', [TicketController::class, 'store'])->middleware('auth');

// User

Route::post('users/authenticate', [UserController::class, 'authenticate'])->middleware('guest');

Route::post('logout', [UserController::class, 'logout'])->middleware('auth');

Route::get('user/edit', [UserController::class, 'edit'])->middleware('auth');

Route::get('login', [UserController::class, 'login'])->middleware('guest')->name('login');

Route::post('user', [UserController::class, 'update'])->middleware('auth');

Route::get('change-password', [UserController::class, 'editPassword'])->middleware('auth');

Route::post('change-password', [UserController::class, 'updatePassword'])->middleware('auth');

Route::get('users', [UserController::class, 'index'])->middleware('auth');
