<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Application\FrontController;


Route::post('getProduct', [FrontController::class, 'getProduct']);

Route::get('getProductDetails/{id}', [FrontController::class, 'getProductDetails']);
