<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DomainCheckerController;
use App\Http\Controllers\RegistrarController;

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

Route::get('/', [DomainCheckerController::class, 'viewDomainChecker']);
Route::get('/domeny', [DomainCheckerController::class, 'viewDomains']);
Route::get('/domeny/{id}', [DomainCheckerController::class, 'viewRegistrant']);

Route::get('/registratori', [RegistrarController::class, 'viewRegistrars']);
Route::get('/registratori/{id}', [RegistrarController::class, 'viewRegistrar']);

