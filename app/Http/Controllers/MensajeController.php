<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MensajeController extends Controller
{
    public function funEnviarMensaje(Request $request){
        $token = "EAALckkZBTqzoBQ7CXYpa7SkC98C2tfqY4m4v5crkcFc0y5iH20LlHB2QFD68qrLKKu5g1QRnNQB8cvYZBNl3Qs8OYmPapnrBMP8ZCz0B6RoK4GnHqxhI5nAOtGbUIc1nq9nDcHUxcwK21LBVZADuHbhGSHWQqENlEdN6ZBVRaWVQ4MzAZCo69qtu1ifdiOfAiMlemEzsr5rsxcD61cabC97eex7hX1cBaN43dDKCJTVXhgLxCuOCeFxFvrPWzCpqZCSkA8KW3370UYH3pgYvBV9GXIr";
        $phone_id = "";

        Http::withToken($token)->post("https://graph.facebook.com/v22.0/388467921024360/messages", [
            "messaging_product" => "whatsapp",
            "recipient_type"=> "individual",
            "to"=> "59173277937",
            "type"=> "text",
            "text" => [
                "preview_url" => true,
                "body" => $request->mensaje
            ]
        ]);

        Http::withToken($token)->post("https://graph.facebook.com/v22.0/388467921024360/messages", [
            "messaging_product" => "whatsapp",
            "recipient_type"=> "individual",
            "to"=> "59173277937",
            "type"=> "image",
            "image" => [
                "link" => "https://static.vecteezy.com/system/resources/thumbnails/009/273/280/small/concept-of-loneliness-and-disappointment-in-love-sad-man-sitting-element-of-the-picture-is-decorated-by-nasa-free-photo.jpg",
                "caption"=> "Hola este es un ejemplo desde Laravel"
            ]
        ]);

        return redirect()->back();
    }


    public function panelAdmin(){
        return view("panel-contacto");
    }
}
