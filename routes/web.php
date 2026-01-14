<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProjectController;
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
/*
Route::get('/', function () {
    return view('welcome');
});
*/

// CRUD admin Projects
Route::resource('projects', ProjectController::class);
use App\Models\Project;

Route::get('/', function () {
    return view('home', [
        'projects' => Project::all(),
        // plus tard: services, counters, clients, etc.
    ]);
})->name('home');


