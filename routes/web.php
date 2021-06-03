<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;

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

Route::get('/', function() {
    return view('home');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');
    
// Uma forma de aplicar um middleware
//->middleware('auth');

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
// Não aplicou o nome por que ele "herda" do acima.
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/posts', [PostController::class, 'index'])->name('posts');
// Herda o nome da de cima
Route::post('/posts', [PostController::class, 'store']);
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

//Likes
// 1 forma: a rota seria chamada assim no form: action="{{ route('posts.likes', $post->id)}}"
//Route::post('/posts/{id}/likes', [PostLikeController::class, 'store'])->name('posts.likes');

// 2 forma: model binding, mesmo passando o $post->id na rota, o laravel saberá e pegará o modelo todo do banco com as infos
// recomenda-se passar apenas o model mesmo para ficar mais intuitivo: {{ route('posts.likes', $post)}}
Route::post('/posts/{post}/likes', [PostLikeController::class, 'store'])->name('posts.likes');

// Dar Unlike -- pode usar o mesmo nome de posts.likes por que o método http é outro (destroy)
Route::delete('/posts/{post}/likes', [PostLikeController::class, 'destroy'])->name('posts.likes');

