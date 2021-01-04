<?php

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

use App\Http\Controllers\TodoController;

// Route::middleware('auth')->group(function() {
    // Resource route will replace below 6 lines
    Route::resource('/todo', TodoController::class);
    // Route::get('/todos', [TodoController::class, 'index'])->name('todo.index');
    // Route::get('/todos/create', [TodoController::class, 'create']);
    // Route::get('/todos/{todo}/edit', [TodoController::class, 'edit']);
    // Route::post('/todos/create', [TodoController::class, 'store']);
    // Route::patch('/todos/{todo}/update', [TodoController::class, 'update'])->name('todo.update');
    // Route::delete('/todos/{todo}/delete', [TodoController::class, 'destroy'])->name('todo.delete');

    Route::put('/todos/{todo}/complete', [TodoController::class, 'complete'])->name('todo.complete');
    Route::put('/todos/{todo}/incomplete', [TodoController::class, 'incomplete'])->name('todo.incomplete');
// });


Route::get('/', function () {
    // return env('APP_NAME');
    return view('welcome');
    // return View::make('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/user', 'App\Http\Controllers\UserController@index');

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
Route::post('/upload', [UserController::class, 'uploadAvatar']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
