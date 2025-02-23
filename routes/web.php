<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

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

Route::get('/', [PageController::class, 'show']);

Route::post('/save_page', [PageController::class, 'savePage'])->name('page.save');
Route::get('download/{filename}', [PageController::class, 'download'])->name('file.download');
