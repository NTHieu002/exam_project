<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use GuzzleHttp\Handler\Proxy;

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
    return view('layout');
});
Route::get('/home', function () {
    return view('layout');
});

Route::get('/admin/login', [UserController::class, 'index'])->name('login');
Route::post('post-login', [UserController::class, 'postLogin'])->name('login.post'); 
Route::get('/admin/registration', [UserController::class, 'registration'])->name('register');
Route::post('post-registration', [UserController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [UserController::class, 'dashboard']); 
Route::get('logout', [UserController::class, 'logout'])->name('logout');


Route::get('/admin/all-product', [ProductController::class, 'index']);
Route::get('/admin/add-product', [ProductController::class, 'add_product']);
Route::post('/admin/save-product', [ProductController::class, 'save_product']);
Route::get('/unActive-product/{product_id}',[ProductController::class,'unActive_product']);
Route::get('/active-product/{product_id}',[ProductController::class,'active_product']);
Route::get('/admin/edit-product/{product_id}',[ProductController::class,'edit_product']);
Route::post('/admin/update-product/{product_id}',[ProductController::class,'update_product']);
Route::get('/delete-product/{product_id}',[ProductController::class,'delete_product']);
Route::get('/product-detail/{product_id}', [ProductController::class ,'product_detail']);