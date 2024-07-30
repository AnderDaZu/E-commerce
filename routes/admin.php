<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "Hi, from admin";
})->name('dashboard');