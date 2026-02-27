<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\InventoryController;

Route::redirect('/', '/inventory');

Route::prefix('inventory')
    ->name('inventory.')
    ->controller(InventoryController::class)
    ->group(function () {

        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });


