<?php

use App\Http\Controllers\CatalogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('catalog.index');
});

Route::get('/katalog', [CatalogController::class, 'index'])
    ->name('catalog.index');
Route::post('/katalog', [CatalogController::class, 'store'])
    ->name('catalog.store');
Route::put('/katalog/{product}', [CatalogController::class, 'update'])
    ->name('catalog.update');
Route::delete('/katalog/{product}', [CatalogController::class, 'destroy'])
    ->name('catalog.destroy');
