<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OpenaiController extends Controller
{
    
    public function funRespuestaIA(Request $request){
        $respuesta = Http::withHeaders([
            'Content-Type' => "application/json",
            'Authorization' => "Bearer "+env("TOKEN_OPENAI")
        ])->post("https://api.openai.com/v1/chat/completions", [
            "model" => "gpt-5",
            "messages" => [
                [
                    "role" => "system",
                    "content" => "Actua como parte del equipo de ventas del banco credito seguro responde en no más de 30 palabras."
                ],
                [
                    "role" => "user",
                    "content" => $request->mensaje
                ],
                
            ]
        ]);

        return response()->json([
            "status" => $respuesta->status(),
            "response" => $respuesta['choices'][0]['message']['content']
        ]);
    }
}
