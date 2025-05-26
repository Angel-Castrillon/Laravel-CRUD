<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CRUDController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;



Route::prefix('CRUD')->name('CRUD.')->controller(CRUDController::class)->group(function () {
    Route::get('/', 'index')->name('index'); // Inicio
    
    //* Rutas crud
    Route::get('/create', 'create')->name('create'); // Crear un alquiler de un e-book
    Route::get('/{id}/edit', 'edit')->name('edit'); // Editar los datos de alquiler de un E-book
    Route::put('/{id}', 'update')->name('update'); // Actualizar el alquiler con los datos enviados
    Route::delete('/{id}', 'destroy')->name('destroy'); // Eliminar el alquiler de la base de datos

    //* Rutas alquiler
    Route::get('/catalogo', 'catalogo')->name('catalogo'); // Catalogo de e-books
    Route::get('/rentals', 'rentals')->name('rentals'); // Mostrar listado de libros alquilados
    Route::post('/rent', 'rent')->name('rent'); // Envio de formulario de crear un alquiler de un e-book



});

Route::prefix('Auth')->name('Auth.')->controller(AuthController::class)->group(function () {
    
    //* Rutas Auth
    Route::middleware('auth')->group(function () {
        Route::get('/logout', 'logout')->name('logout'); // Cerrar sesión
    });
    //* Rutas Guest
    Route::middleware('guest')->group(function () {
        Route::get('/login', 'login')->name('login'); // Login
        Route::post('/login', 'postLogin')->name('postLogin'); // Envio de formulario Login

        Route::get('/register', 'register')->name('register'); // Register
        Route::post('/register', 'postRegister')->name('postRegister'); // Envio de formulario Register
    });
    
});

// Rutas de perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
