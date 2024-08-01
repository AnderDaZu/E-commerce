<?php

use App\Http\Controllers\Admin\FamilyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::resource('family', FamilyController::class)->names('families');