<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserPredictionController;
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


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/home/search_prediction',[HomeController::class, 'searchPrediction'])->name('search.prediction');
Route::get('/get_user_search_prediction',[HomeController::class,'getUserSearches'])->name('user.prediction.searches');
