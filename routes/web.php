<?php

use App\Http\Controllers\usercontroller;
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

Route::get('/login','usercontroller@login')->name('login');
Route::post('/postlogin','usercontroller@postlogin')->name('postLogin');
Route::middleware('auth')->get('/','usercontroller@home')->name('home');
Route::get('/register','usercontroller@register')->name('register');
Route::post('/postRegister','usercontroller@postRegister')->name('postRegister');

Route::middleware('auth')->resource('produk','produkcontroller');
Route::middleware('auth')->resource('kategori','kategoricontroller');
Route::post('/logout','usercontroller@logout')->name('logout');