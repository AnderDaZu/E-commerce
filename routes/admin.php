<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FamilyController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubcategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::resource('families', FamilyController::class)->names('families');

Route::resource('categories', CategoryController::class)->names('categories');

Route::resource('subcategories', SubcategoryController::class)->names('subcategories');

Route::resource('products', ProductController::class)->names('products');