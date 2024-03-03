<?php

use App\Livewire\Counter;
use App\Livewire\Customers\CreateCustomer;
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

Route::get('/', Dashboard::class)->middleware(['auth']);

Route::middleware(['auth'])->group(function(){
   
    Route::get('/customers',CustomersList::class)->name('customers.index');
    Route::get('/customers/create',CreateCustomer::class)->name('customers.create');
});