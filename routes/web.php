<?php

// use App\Http\Controllers\ProjectController;
use App\Http\Livewire\Projects;
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
    redirect('/projects');
});

// Route::resource('projects', ProjectController::class);
Route::get('/projects', Projects\Show::class);
Route::get('/projects/{id}', Projects\ShowById::class);
