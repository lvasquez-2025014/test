<?php

use App\Http\Controllers\OpenaiController;
use App\Http\Controllers\whatsappController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("/enviar-mensaje", [whatsappController::class, "enviarMensaje"]);

// Recibir Mensajes
Route::post('/webhook', [whatsappController::class, "recibirMensaje"]);

// webhook Verify
Route::get('/webhook', function(Request $request){
    if($request->hub_verify_token === env('VERIFY_TOKEN')){
        return $request->hub_challenge;
    }
    return response('Forbidden', 403);
});

// APi OPEN AI

Route::post("/openai/text", [OpenaiController::class, "funRespuestaIA"]);
