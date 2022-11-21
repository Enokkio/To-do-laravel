<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectUserController;
use App\Http\Controllers\todoController;
use App\Models\project_user;
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
Route::resource('list', todoController::class);

Route::get('list/test',[todoController::class, 'test']);



Route::resource('project', ProjectController::class);
Route::resource('ProjectUser', ProjectUserController::class);


// Route::get(`project/show/.$id`, function () {
//     dd('hello i am ching chong');
// });


Route::get('/', function () {
    return view('auth.register');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
