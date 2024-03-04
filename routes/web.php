<?php

use App\Livewire\Brands\BrandList;
use App\Livewire\Categories\CategoryList;
use App\Livewire\Customers\CustomersList;
use App\Livewire\Dashboard;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/', Dashboard::class);
    Route::get('/customers', CustomersList::class)->name('customers.index');
    Route::get('/brands', BrandList::class)->name('brands.index');
    Route::get('/categories', CategoryList::class)->name('categories.index');
});
