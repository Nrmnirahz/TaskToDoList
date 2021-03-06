<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\TodolistsController;
use App\Http\Controllers\taskController;
use App\Models\Todolists;

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
    return view('welcome');
});


require __DIR__.'/auth.php';

Route::post('/storetask/{id}', [taskController::class, 'store']); // store data for task
Route::post('/storelist', [TodolistsController::class, 'store'])->name('storelist'); // store data for list
Route::post('/destroytask/{id}', [taskController::class, 'destroy']); // delete data for task
Route::post('/destroylist/{id}', [TodolistsController::class, 'destroy']); // delete data for list
Route::post('/editlist/{id}', [TodolistsController::class, 'edit'])->name('editlist');; //edit data for list
Route::post('/edittask/{id}', [taskController::class, 'edit'])->name('edittask'); //edit data for task
Route::get('service/post/gate', 'PostController@gate');
Route::get('service/post/view', 'PostController@view');
Route::get('service/post/create', 'PostController@create');
Route::get('service/post/update', 'PostController@update');
Route::get('service/post/delete', 'PostController@delete');

//For view
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [TodolistsController::class, 'index'])->name('dashboard');
    Route::get('/task', [taskController::class, 'task'])->name('task');
    Route::post('/listedit/{id}', [TodolistsController::class, 'listedit']);
    Route::post('/taskedit/{id}', [taskController::class, 'taskedit']);
});

