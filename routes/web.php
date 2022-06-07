<?php

use App\Http\Controllers\DetailController;
use App\Http\Controllers\LawankataController;
use App\Http\Controllers\levenshteinController;
use App\Http\Controllers\PencarianController;
use App\Http\Controllers\PencarianTextController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenjelajahanController;

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
    return view('beranda',[
        "title" => "Beranda"
    ]);
});

Route::get('/penjelajahan', [PenjelajahanController::class, 'index']);

Route::get('/penjelajahan/{class}', [PenjelajahanController::class, 'class']);

Route::get('/penjelajahan/{class}/{individual}', [PenjelajahanController::class, 'individual']);

Route::get('/detail/{katabali}', [DetailController::class, 'detail']);

Route::get('/pencarian', [PencarianController::class, 'searching']);

Route::get('/pencariantext', [PencarianTextController::class, 'searching']);

Route::get('/lawankata', [LawankataController::class, 'lawankata']);

Route::get('/test', [levenshteinController::class,'levenshteinAlgorithm']);
