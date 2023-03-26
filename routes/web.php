<?php

use App\Http\Controllers\Admins\Category\CategoryController;
use App\Http\Controllers\Admins\DashboardController;
use App\Http\Controllers\Clients\DashboardController as ClientsDashboardController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });
// start shop 





// end shop
Auth::routes();
/*------------------------------------------

--------------------------------------------

All Normal Users Routes List

--------------------------------------------

--------------------------------------------*/

Route::middleware(['auth', 'user-access:client'])->group(function () {

    Route::get('/clients/dashboard/', [ClientsDashboardController::class, 'index'])->name('client.dashboard');
});



/*------------------------------------------

--------------------------------------------

All Admin Routes List

--------------------------------------------

--------------------------------------------*/

Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    // category management
    Route::get('/admin/category/all-category', [CategoryController::class, 'index'])->name('admin.category');
    Route::post('/admin/category/new-category/add', [CategoryController::class, 'store'])->name('admin.new-category');
    // datatables 
    Route::get('/admin/datatable/category',[CategoryController::class,'get_all_category'])->name('admin.cateory-all');
});
Route::get('/', [\App\Http\Controllers\Shop\HomeController::class, 'index'])->name('shop.home');
Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
