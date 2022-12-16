<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerroController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/ApiRoutes')->group(function () use ($router) {
    $router->get('/getPerros', [PerroController::class, 'listarPerros']);
    $router->post('/crearPerro', [PerroController::class, 'crearPerro']);
    $router->post('/eliminarPerro', [PerroController::class, 'eliminarPerro']);
    $router->post('/actualizarPerro', [PerroController::class, 'actualizarPerro']);
    $router->post('/guardarPreferencia', [PerroController::class, 'guardarPreferPerros']);
    $router->post('/consultarPerroInteresado', [PerroController::class, 'consultarPerroInteresado']);
});
