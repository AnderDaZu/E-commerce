<?php

use App\Models\Category;
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

Route::get('categories', function (Request $request) {
    $term = $request->term ?? '';

    return Category::select('name')
        ->where('name', 'like', "%$term%")
        ->limit(10)
        ->get()->map(function ($category) {
            return [
                'id' => $category->name,
                'text' => $category->name,
            ];
        });
})->name('api.categories.index');

Route::post('sasa', function () {
    $token = getToken();
    return updateAccount($token);
});

function getToken()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://vardi-pruebas.sics.com.co/sics360-Masivos/api/InicioSesion/IniciarSesion',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
            "Usuario":"123",
            "Clave":"123",
            "KeySecret":"j3iANSX9T5zDePV4aWBB5eCiVaVXrhayzqBGtwKHWRrmR37jdc"
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response)->Access;
}

function updateAccount($token)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://vardi-pruebas.sics.com.co/sics360-Masivos/api/Cliente/ModificarCliente',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
            "TipoIdentificacion": 13,
            "DocumentoCliente": "17145952658", 
            "Nombres":"Jhon Mantilla 1",
            "FechaNacimiento":"1987-01-27", 
            "TipoPersona":1,
            "CodigoDepartamento":5,
            "CodigoMunicipio":1,
            "Celular":"3203203203",
            "Direccion":"Av 47 N 58-52",
            "Direccion2":"",
            "Correo":"analistadesarollo2@sasaconsultoria.com",
            "Telefono": "6219279",
            "Telefono2":"",
            "Genero":1,
            "Fax":"",
            "CorreoAlterno":""
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            "Authorization: Bearer $token"
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response);
}