<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backend\AdminUserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\AttributeController;
use App\Http\Controllers\Backend\TermsController;
use App\Http\Controllers\Backend\ProductsController;
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
    return view('welcome');
});



Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::prefix('admin')->name('admin.')->middleware('is_admin')->group(function(){
    Route::get('home', [HomeController::class, 'adminHome'])->name('home');

    Route::resource('all-user', AdminUserController::class);
    Route::get('user/datatable/ssd', [AdminUserController::class, 'ssd'])->name('datatable');

    Route::resource('category', CategoryController::class);
    Route::get('category/datatable/ssd', [CategoryController::class, 'ssd'])->name('category');

    Route::resource('tag', TagController::class);
    Route::get('tag/datatable/ssd', [TagController::class, 'ssd'])->name('tag');

    Route::resource('attribute', AttributeController::class);
    Route::get('attribute/datatable/ssd', [AttributeController::class, 'ssd'])->name('attribute');
    
    Route::resource('terms', TermsController::class);
    Route::any('terms/create-terms/terms/{id}', [TermsController::class, 'delete']);
    Route::get('terms/create-terms/{id}', [TermsController::class, 'addTermData'])->name('addTermData');
    Route::get('terms/datatable/ssd/{id}', [TermsController::class, 'ssd'])->name('terms');

    Route::resource('products', ProductsController::class);
    Route::get('attributes/{id}',[ProductsController::class, 'attributes'])->name('attributes');
    Route::get('products/datatable/ssd', [ProductsController::class, 'ssd'])->name('products');
});