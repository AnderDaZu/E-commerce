<?php

use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('families', function (Request $request) {
    $term = $request->term ?? '';

    return Family::select('name')
        ->where('name', 'like', "%$term%")
        ->limit(10)
        ->get()->map(function ($family) {
            return [
                'id' => $family->name,
                'text' => $family->name,
            ];
        });
})->name('api.families.index');