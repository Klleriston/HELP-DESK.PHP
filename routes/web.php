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

// TICKET ROUTES:
Route::get('/tickets', [Ticketcontroller::class, 'getAllTickets']);
Route::get('/tickets/{id}', [Ticketcontroller::class, 'getTicketsById']);
Route::post('/tickets/create', [Ticketcontroller::class, 'createTicket'])->withoutMiddleware(['web', 'csrf']);
Route::put('/ticket/update/{id}', [Ticketcontroller::class, 'updateTicket'])->withoutMiddleware(['web', 'csrf']);
Route::delete('/ticket/delete/{id}', [Ticketcontroller::class, 'deleteTicket'])->withoutMiddleware(['web', 'csrf']);

// USER ROUTES:
Route::get('/users', [Usercontroller::class, 'gealltUsers']);
Route::get('/users/{id}', [Usercontroller::class, 'getUserById']);
Route::post('/users/create', [Usercontroller::class, 'createUser'])->withoutMiddleware(['web', 'csrf']);
Route::put('/users/update/{id}', [Usercontroller::class, 'updateUser'])->withoutMiddleware(['web', 'csrf']);
Route::delete('/user/delete/{id}', [Usercontroller::class, 'deleteUser'])->withoutMiddleware(['web', 'csrf']);
