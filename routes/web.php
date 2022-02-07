<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MontaController;


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

Route::get('/',[PostController::class, 'index'])
    ->name('posts.index');

Route::get('/posts/{post}',[PostController::class, 'show'])
    ->name('posts.show')
    ->where('post', '[0-9]+');

Route::get('/posts/create',[PostController::class, 'create'])
    ->name('posts.create');

Route::post('/posts/store',[PostController::class, 'store'])
    ->name('posts.store');

Route::get('/posts/{post}/edit',[PostController::class, 'edit'])
    ->name('posts.edit')
    ->where('post', '[0-9]+');

Route::patch('/posts/{post}/update',[PostController::class, 'update'])
    ->name('posts.update')
    ->where('post', '[0-9]+');

Route::delete('/posts/{post}/destroy',[PostController::class, 'destroy'])
    ->name('posts.destroy')
    ->where('post', '[0-9]+');

Route::get('/monta/', [MontaController::class, 'mondex'])
    ->name('monta.index');

Route::get('/monta/posts/{post}',[MontaController::class, 'show'])
    ->name('monta.show')
    ->where('post', '[0-9]+');

Route::get('/monta/posts/create',[MontaController::class, 'create'])
    ->name('monta.create');

Route::post('/monta/posts/store',[MontaController::class, 'store'])
    ->name('monta.store');

Route::get('/monta/posts/{post}/edit',[MontaController::class, 'edit'])
    ->name('monta.edit')
    ->where('post', '[0-9]+');

Route::patch('/monta/posts/{post}/update',[MontaController::class, 'update'])
    ->name('monta.update')
    ->where('post', '[0-9]+');

Route::delete('/monta/posts/{post}/destroy',[MontaController::class, 'destroy'])
    ->name('monta.destroy')
    ->where('post', '[0-9]+');
