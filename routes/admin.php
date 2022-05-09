<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PharmacyController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PharmacyProductController;


 Route::resource('pharmacy', 'PharmacyController');
 Route::resource('product', 'ProductController');
 Route::resource('pharmacyProduct', 'PharmacyProductController');

