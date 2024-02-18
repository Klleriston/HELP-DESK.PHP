<?php

use App\Http\Controllers\Ticketcontroller;
use App\Http\Controllers\Usercontroller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tickets', [Ticketcontroller::class, 'getAllTickets'])->where(name: 'getAllTickets', expression: '[A-Z]+');

Route::get('/tickets/{id}', [Ticketcontroller::class, 'getTicketsById'])->where(name: 'getAllTickets', expression: '[A-Z]+');



Route::get('/users', [Usercontroller::class, 'gealltUsers']);

Route::get('/users/{id}', [Usercontroller::class, 'getUserById']);

Route::post('/users/create', [Usercontroller::class, 'createUser']);

Route::put('/users/update/{id}', [Usercontroller::class, 'updateUser']);

Route::delete('user/delte/{id}', [Usercontroller::class, 'deleteUser']);