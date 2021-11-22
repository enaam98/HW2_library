<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\CreateController;
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

Route::get('/filemanager', function () {
    return view('filemanager');
});
//-------------------filemanager
Route::get('/filemanager', [CreateController::class, 'index']);
Route::get('/files/{id}', [FilesController::class, 'show'])->name('file.show');
//-------------------create
Route::get('/create', [FilesController::class, 'index'])->name('file.create');
Route::post('/create', [FilesController::class, 'store']);
// Route::delete('/destroy', [CategoriesController::class, 'destroy'])->name('destroy');

// Route::get('/create' , 'FilesController@index')->name('create');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
