<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MonitoredPlaceController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
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

Route::get('/', function () {
    return to_route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('places', PlaceController::class)->only('show', 'create', 'store', 'destroy');
    Route::post('/places/{id}/reviews', [ReviewController::class, 'store'])->name('places.reviews.store');
    Route::get('/search-results', SearchController::class)->name('search');
    Route::get('/monitored-places/{id}', [MonitoredPlaceController::class, 'show'])->name('monitored-places.show');
});

require __DIR__.'/auth.php';
