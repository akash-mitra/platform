<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\SeriesController;
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

Route::get('/', fn() => view('public.home'));

/* Posts */
Route::post('/posts/{post}/like', [PostLikeController::class, 'like'])->name('posts.like');
Route::post('/posts/{post}/dislike', [PostLikeController::class, 'dislike'])->name('posts.dislike');
Route::post('/posts/{post}/unlike', [PostLikeController::class, 'unlike'])->name('posts.unlike');
Route::post('/posts/{post}/undislike', [PostLikeController::class, 'undislike'])->name('posts.undislike');


Route::get('/series', [SeriesController::class, 'index'])->name('series.index');
Route::get('/series/{series:slug}', [SeriesController::class, 'get'])->name('series');
Route::get('/series/{series:slug}/posts/{post}', [SeriesController::class, 'getPost'])->name('series.post')->scopeBindings();






//Route::get('/dashboard', fn() => view('backend.dashboard'))->middleware(['auth', 'verified'])->name('dashboard');
////
//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

require __DIR__.'/auth.php';
Route::get('/auth/{provider}/redirect', [SocialLoginController::class, 'redirectToProvider'])->name('social.login');
Route::get('/auth/{provider}/callback', [SocialLoginController::class, 'handleProviderCallback'])->name('social.callback');

