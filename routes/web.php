<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ContactoController;
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
    return view('welcome');
}) -> name('home');


Route::resource('books' , BookController::class);
Route::resource('authors' , AuthorController::class) -> except('show');


//todo Rutas para el email
Route::get('contacto' , [ContactoController::class ,  'pintarFormulario']) -> name('email.pintar');
Route::post('contacto' , [ContactoController::class  , 'procesarFormulario']) -> name('email.enviar');


