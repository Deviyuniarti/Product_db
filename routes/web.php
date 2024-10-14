<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ProductController};
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\PurchaseOrderController;


    Route::get('/product', [ProductController::class, 'index']);
    Route::get('/product/create', [ProductController::class, 'create']);
    Route::post('/product/simpan-data', [ProductController::class, 'store']);
    Route::get('/product/view/{id}', [ProductController::class, 'view']); 
    Route::get('/product/edit/{id}', [ProductController::class, 'formEdit']);
    Route::post('/product/update/{id}', [ProductController::class, 'update']);
    Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

