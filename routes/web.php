<?php

use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProdutoController;
use App\Repository\UserRepository;
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

Route::get('/', function () {
    return UserRepository::findByLastedCreated();
    // return view('welcome');
});

Route::get('/marcas/parceiras', [
    MarcaController::class, "marcasParceiras"
]);
Route::get('/marcas/proibidas', [
    MarcaController::class, "marcasProibidas"
]);
Route::get('/marcas/validadas', [
    MarcaController::class, "marcasValidadas"
]);
Route::get('/produtos/mais-baratos', [
    ProdutoController::class, "maisBarato"
]);
Route::get('/produtos/mais-caros', [
    ProdutoController::class, "maisCaro"
]);
Route::get('/produtos/peso-cubado/{produto}', [
    ProdutoController::class, "pesoCubado"
]);


