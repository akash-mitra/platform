<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialLoginController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/page', fn() => view('private.page_old'));
Route::get('/posts/{post}', [PostController::class, 'get'])->name('post');

Route::get('/subjects/{subject}', fn() => view('private.subject'))->name('subject');

Route::get('/series/{slug}/{post}', [PostController::class, 'getSeriesPost'])->name('series.post');



Route::post('/posts/{post}/like', [PostLikeController::class, 'like'])->name('posts.like');
Route::post('/posts/{post}/dislike', [PostLikeController::class, 'dislike'])->name('posts.dislike');
Route::post('/posts/{post}/unlike', [PostLikeController::class, 'unlike'])->name('posts.unlike');
Route::post('/posts/{post}/undislike', [PostLikeController::class, 'undislike'])->name('posts.undislike');

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

