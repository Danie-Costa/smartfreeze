<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\LocalizacaoController;

use App\Http\Controllers\DevicesController;
use App\Http\Controllers\RecipientsController;
//novaControler



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
Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::middleware(['auth', 'permission'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('plans', PlansController::class);
    Route::resource("companies", CompaniesController::class);
    Route::resource("devices", DevicesController::class);
    Route::resource("recipients", RecipientsController::class);
    Route::get('busca-cidades/{estado}', [LocalizacaoController::class, 'cidadesPorEstado'])->name('busca-cidades');

});



