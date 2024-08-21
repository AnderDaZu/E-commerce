<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('prueba', function () {

    $array1 = ['a', 'b', 'c'];
    $array2 = ['a', 'b', 'c'];
    $array3 = ['a', 'b', 'c'];

    $arrays = [$array1, $array2, $array3];

    $combinaciones = generarCombinaciones($arrays);
    return $combinaciones;
});

function generarCombinaciones( $arrays, $indice = 0, $combinacion = [] )
{
    if ( $indice == count($arrays) ) {
        return [$combinacion];
    }

    $resultado = [];

    foreach ( $arrays[$indice] as $item ) {
        $combinacionTemporal = $combinacion;
        $combinacionTemporal[] = $item;
        $resultado = array_merge($resultado, generarCombinaciones($arrays, $indice + 1, $combinacionTemporal));
    }

    return $resultado;
}