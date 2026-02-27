<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\InventoryController;


Route::prefix('tugas')
    ->name('members.')
    ->controller(MemberController::class)
    ->group(function () {

        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('/view/{id}', 'view')->name('view');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });


Route::get('/', [InventoryController::class, 'index'])->name('inventory.index');
Route::post('/', [InventoryController::class, 'store'])->name('inventory.store');
Route::get('/edit/{id}', [InventoryController::class, 'edit'])->name('inventory.edit');
Route::put('/{id}', [InventoryController::class, 'update'])->name('inventory.update');
Route::delete('/{id}', [InventoryController::class, 'destroy'])->name('inventory.destroy');


