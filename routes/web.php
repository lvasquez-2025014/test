<?php

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MensajeController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect("/login");//view('welcome');
});

// Saludo
Route::get("/saludo/{nombre}/pais/{pais}", function($nom, $pais){
    return [
        "mensaje" => "Hola " . $nom,
        "mensaje2" => "Saludos a: " . $pais,
    ];
});

Route::get("/saludo2", function(){
    return "Hola Bienvenidos al curso de Chatbot con Laravel";
});

Route::get("/tecnologias", function(){
    return ["Java", "Php", "Python", "Go", "Ruby"];
});

Route::get("/nosotros", function(){
    return view("acerca");
});

Route::get("/blog", function(){
    return view("blog");
});

Route::get("/inicio", function(){
    return view("inicio");
});

Route::get("/servicios", function(){
    return view("servicio");
});

Route::post("/mi-mensaje", [MensajeController::class, "funEnviarMensaje"]);
Route::get("/panel-contactos", [MensajeController::class, "panelAdmin"]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
