<?php

use App\Http\Controllers\ProductController;
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

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::get('/register', [ProductController::class, 'create'])->name('products.create');
Route::post('/register', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::post('/products/confirm', [ProductController::class, 'confirm']);
Route::get('/products/register', [ProductController::class, 'registerForm'])->name('products.registerForm');
