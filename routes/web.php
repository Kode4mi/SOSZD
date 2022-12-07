<?php

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ReplyController;
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

Route::middleware(['auth'])->group(function () {

// Ticket

    Route::get('tickets', [TicketController::class, 'index']);

    Route::get('ticket/create', [TicketController::class, 'create']);

    Route::get('ticket/{ticket}', [TicketController::class, 'show']);

    Route::post('ticket', [TicketController::class, 'store']);

// Redirect

    Route::get('redirect/{ticket}', [RedirectController::class, 'index']);

    Route::post('redirect/{ticket}', [RedirectController::class, 'store']);

// Reply

    Route::get('reply/{redirect}', [ReplyController::class, 'show']);

    Route::get('reply/create/{redirect}', [ReplyController::class, 'create']);

    Route::post('reply/{redirect}', [ReplyController::class, 'store']);

// Archive

    Route::get('archives', [ArchiveController::class, 'index']);

    Route::put('archive', [ArchiveController::class, 'archive']);

    Route::put('unarchive', [ArchiveController::class, 'unarchive']);

// User

    Route::post('logout', [UserController::class, 'logout']);

    Route::get('user/edit', [UserController::class, 'edit']);

    Route::get('user/register', [UserController::class, 'register']);

    Route::put('user', [UserController::class, 'update']);

    Route::post('user', [UserController::class, 'store']);

    Route::get('change-password', [UserController::class, 'editPassword']);

    Route::post('change-password', [UserController::class, 'updatePassword']);

    Route::middleware(['admin'])->group(function () {

        Route::get('users', [UserController::class, 'index']);

    });
});

//Logowanie

Route::middleware(['guest'])->group(function () {

    Route::get('login', [UserController::class, 'login'])->name('login');

    Route::post('users/authenticate', [UserController::class, 'authenticate']);

    Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPassword']);
    Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPassword']);
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPassword']);
    Route::post('reset-password/{token}', [ForgotPasswordController::class, 'submitResetPassword']);

    Route::get('create-password/{token}', [UserController::class, 'showCreatePassword']);
    Route::put('create-password', [UserController::class, 'submitCreatePassword']);

});
