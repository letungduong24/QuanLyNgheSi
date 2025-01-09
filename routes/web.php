<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ScheduleDetailController;
use App\Http\Controllers\SongController;
use HRTime\PerformanceCounter;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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
    return redirect('/dashboard');
})->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('auth');

Route::get('/signin', function () {
    return view('account-pages.signin');
})->name('signin');

Route::get('/sign-in', [LoginController::class, 'create'])
    ->middleware('guest')
    ->name('sign-in');

Route::post('/sign-in', [LoginController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/artists', action: [ArtistController::class, 'index'])->name('artists.index')->middleware('auth');
Route::get('/artists/{id}', action: [ArtistController::class, 'show'])->name('artists.show')->middleware('auth');
Route::delete('/artists/{id}', action: [ArtistController::class, 'destroy'])->name('artists.destroy')->middleware('auth');
Route::put('/artists/{id}/update', action: [ArtistController::class, 'update'])->name('artists.update')->middleware('auth');
Route::post('/artists/store', [ArtistController::class, 'store'])->name('artists.store')->middleware('auth');

Route::get('/schedules', action: [ScheduleController::class, 'index'])->name('schedules.index')->middleware('auth');
Route::get('/schedules/{id}', action: [ScheduleController::class, 'show'])->name('schedules.show')->middleware('auth');
Route::post('/schedules/store', [ScheduleController::class, 'store'])->name('schedules.store')->middleware('auth');


Route::get('/albums', action: [AlbumController::class, 'index'])->name('albums.index')->middleware('auth');
Route::get('/albums/{id}', action: [AlbumController::class, 'show'])->name('albums.show')->middleware('auth');
Route::post('/albums/store', [AlbumController::class, 'store'])->name('albums.store')->middleware('auth');
Route::delete('/albums/{id}', action: [AlbumController::class, 'destroy'])->name('albums.destroy')->middleware('auth');
Route::get('/albums/{id}/edit', action: [AlbumController::class, 'edit'])->name('albums.edit')->middleware('auth');
Route::put('/albums/{id}/add', action: [AlbumController::class, 'add'])->name('albums.add')->middleware('auth');
Route::put('/albums/{id}/remove', action: [AlbumController::class, 'remove'])->name('albums.remove')->middleware('auth');
Route::delete('/albums/{id}', action: [AlbumController::class, 'destroy'])->name('albums.destroy')->middleware('auth');

Route::get('/songs', action: [SongController::class, 'index'])->name('songs.index')->middleware('auth');
Route::get('/songs/search', [SongController::class, 'search'])->name('songs.search')->middleware('auth');
Route::get('/songs/{id}', action: [SongController::class, 'show'])->name('songs.show')->middleware('auth');
Route::post('/songs/store', [SongController::class, 'store'])->name('songs.store')->middleware('auth');
Route::get('/songs/{id}/edit', action: [SongController::class, 'edit'])->name('songs.edit')->middleware('auth');
Route::put('/songs/{id}/update', action: [SongController::class, 'update'])->name('songs.update')->middleware('auth');
Route::delete('/songs/{id}', action: [SongController::class, 'destroy'])->name('songs.destroy')->middleware('auth');

Route::post('/schedulesdetails/store', [ScheduleDetailController::class, 'store'])->name('scheduledetails.store')->middleware('auth');

Route::get('/performance', action: [PerformanceController::class, 'index'])->middleware('auth')->name('performance.index');
Route::get('/performance/bulb', action: [PerformanceController::class, 'bulb'])->name('performance.bulb')->middleware('auth');
Route::get('/performance/resultBulb', action: [PerformanceController::class, 'resultBulb'])->name('performance.resultBulb')->middleware('auth');
Route::get('/performance/lowPerformance', action: [PerformanceController::class, 'lowPerformance'])->name('performance.lowPerformance')->middleware('auth');
Route::get('/performance/artistsActivity', action: [PerformanceController::class, 'artistsActivity'])->name('performance.artistsActivity')->middleware('auth');
Route::get('/performance/trendingSongs', action: [PerformanceController::class, 'trendingSongs'])->name('performance.trendingSongs')->middleware('auth');
Route::get('/performance/comingSchedules', action: [PerformanceController::class, 'comingSchedules'])->name('performance.comingSchedules')->middleware('auth');