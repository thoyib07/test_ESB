<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PopController;
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

// Route::get('/',"");
Route::redirect('/', '/invoice');

Route::resource('invoice', InvoiceController::class);
Route::get('invoice/destroy/{id}',[InvoiceController::class, 'destroy'])->name('invoice.destroy-get');


Route::prefix('popup')->group(function () {
    Route::get('barang', [PopController::class, 'barang'])->name('pop-barang');
});