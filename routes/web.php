<?php

use App\Http\Controllers\TicketsController;
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
   return redirect('/tickets');
});

Route::get('/tickets', [TicketsController::class, 'index']);

Route::get('/ticket/create', [TicketsController::class, 'create']);

Route::get('/ticket/{ticket}', [TicketsController::class, 'show']);


