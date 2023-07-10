<?php

use App\Http\Controllers\Actions\ShowUserProfile;
use App\Http\Controllers\PostController;
use App\Models\Post;
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
    return view('welcome', [
        'posts' => Post::all(),
    ]);
})->name('welcome');

Route::get('post/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('profile/show/{username}', ShowUserProfile::class)->name('profilepage.show');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [PostController::class, 'index']);

    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
});
