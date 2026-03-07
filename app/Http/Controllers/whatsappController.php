<?php

namespace App\Http\Controllers;

use App\Models\ChatbotNode;
use App\Models\Option;
use App\Models\User;
use App\Models\UserContext;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class whatsappController extends Controller
{
    public function enviarMensaje(Request $request)
    {
        // return $request;
        $numero = $request->input('numero');
        $mensajeData = $request->input('mensaje');

        if (!$numero || !$mensajeData) {
            return response()->json(['success' => false, 'error' => 'Faltan datos'], 400);
        }
        try {
            $respuesta = $this->enviarMensajeWhatsapp($numero, $mensajeData);

            return response()->json(['success' => true, 'response' => $respuesta]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function enviarMensajeWhatsapp($numero, $data)
    {
        // cloud, evolution
        $provider = env('WHATSAPP_PROVIDER', 'cloud');

        if ($provider === 'evolution') {
            return $this->enviarEvolution($numero, $data);
        } else {
            return $this->enviarCloud($numero, $data);
        }
    }

    private function enviarCloud($number, $data)
    {
        $url = "https://graph.facebook.com/v22.0/" . env('WHATSAPP_PHONE_NUMBER_ID') . "/messages";
        $token = env('WHATSAPP_ACCESS_TOKEN');

        $payload = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $number,
            "type" => $data['type']
        ];

        switch ($data['type']) {
            case 'text':
                $payload['text'] = ["body" => $data['body']];
                break;
            case 'image':
                $payload['image'] = [
                    "link" => $data['link'],
                    "caption" => $data['caption'] ?? ""
                ];
                break;
            case 'location':
                $payload['location'] = [
                    "latitude" => $data['latitude'],
                    "longitude" => $data['longitude'],
                    "name" => $data['name'],
                    "address" => $data['address']
                ];
                break;
            case 'document':
                $payload['document'] = [
                    "link" => $data['link'],
                    "caption" => $data['caption'],
                    "filename" => $data['filename']
                ];
                break;
            case 'buttons':
                $payload['type']='interactive';
                $payload["interactive"] = [
                    "type" => 'button',
                    "body" => ["text" => $data['body']],
                    "action" => ["buttons" => $data['buttons']]
                ];
                break;
        }

        return  Http::withToken($token)->withHeaders([
            'Content-Type' => 'application/json'
        ])->post($url, $payload)->json();
    }

    private function enviarEvolution($number, $data)
    {

        $urlbase = env('EVOLUTION_API_URL');
        $instance = env('EVOLUTION_INSTANCE');
        $apikey = env('EVOLUTION_API_KEY');

        $url = "";

        $payload = [
            "number" => $number,
        ];

        switch ($data['type']) {
            case 'text':
                $url = "{$urlbase}/message/sendText/{$instance}";
                $payload['text'] = $data['body'];
                break;
            case 'image':
                $url = "{$urlbase}/message/sendMedia/{$instance}";

                $payload['mediatype'] = 'image';
                $payload['media'] = $data['link'];
                $payload['caption'] = $data['caption'] ?? "";
                break;
            case 'location':
                $url = "{$urlbase}/message/sendLocation/{$instance}";

                $payload["latitude"]  = (float) $data['latitude'];
                $payload["longitude"] = (float) $data['longitude'];
                $payload["name"] = $data['name'];
                $payload["address"] = $data['address'];

                break;
            case 'document':
                $url = "{$urlbase}/message/sendMedia/{$instance}";

                $payload['mediatype'] = 'document';
                $payload['media'] = $data['link'];
                $payload['fileName'] = ($data['filename'] ?? 'archivo') . ".pdf";
                $payload['caption'] = $data['caption'] ?? "";
                break;
        }

        return Http::withHeaders(['apikey' => $apikey])->post($url, $payload)->json();
    }

    public function recibirMensaje(Request $request)
    {
        // Log::error("LLEGO MENSAJE: ".$request->all());
        $data = $request->all();
        $message = $data['entry'][0]['changes'][0]['value']['messages'][0] ?? null;

        if (!$message) return response('No hay Mnesaje', 200);

        $numero = $message['from'];
        $mensajeUsuario = "";

        if ($message['type'] === 'text') {
            $mensajeUsuario = trim($message['text']['body']);
        } elseif ($message['type'] === 'interactive') {
            $mensajeUsuario = $message['interactive']['button_reply']['id'];
        }

        // guardar conext del usuario
        $context = UserContext::firstOrCreate(
            ['phone_number' => $numero],
            ['current_node' => 'main']
        );

        if ($context->wasRecentlyCreated) {
            $this->enviarMensajeDinamico($numero, 'main');
            // $this->enviarMensajeDinamicoBotones($numero, 'main');
            return response('OK', 200);
        }


        // buscar la opcion en la BD
        $opcion = Option::where('chatbot_node_id', $context->current_node)
            ->where('key', $mensajeUsuario)
            ->first();
        if (!$opcion) {

            // $this->enviarMensajeWhatsapp($numero, ["type" => "text", "body" => "Debe elegir una opción"]);
            $respuestaIA = $this->funRespuestaIA($mensajeUsuario);
            $this->enviarMensajeWhatsapp($numero, ["type" => "text", "body" => $respuestaIA]);

            return response('OK', 200);
        }

        if ($opcion->respuesta) {
            $this->enviarMensajeWhatsapp($numero, $opcion->respuesta);
        }

        if($opcion->next_node_id){
            $context->update(['current_node' => $opcion->next_node_id]);
            $this->enviarMensajeDinamico($numero, $opcion->next_node_id);
            // $this->enviarMensajeDinamicoBotones($numero, $opcion->next_node_id);
        }


        return response('OK ' . $numero, 200);
    }

    
    public function recibirMensajeEvolution(Request $request)
    {
        $data = $request->all();

        // Validar evento correcto
        if (($data['event'] ?? null) !== 'messages.upsert') {
            return response('Evento no válido', 200);
        }

        $msgPropio = $data['data']['key']['fromMe'] ?? true;

        if ($msgPropio) {
            return response('Mensaje propio', 200);
        }

        // Obtener número limpio
        $remoteJid = $data['data']['key']['remoteJid'] ?? null;
        if (!$remoteJid) return response('Sin número', 200);

        $numero = explode('@', $remoteJid)[0];

        $nombre = $data['data']["pushName"];

        // Detectar tipo de mensaje
        $mensajeUsuario = "";

        $messageType = $data['data']['messageType'] ?? null;
        $messageData = $data['data']['message'] ?? [];

        if ($messageType === 'conversation') {
            $mensajeUsuario = trim($messageData['conversation'] ?? '');
        }

        if ($messageType === 'extendedTextMessage') {
            $mensajeUsuario = trim($messageData['extendedTextMessage']['text'] ?? '');
        }

        if ($messageType === 'buttonsResponseMessage') {
            $mensajeUsuario = $messageData['buttonsResponseMessage']['selectedButtonId'] ?? '';
        }

        if (!$mensajeUsuario) {
            return response('No hay mensaje válido', 200);
        }

        // ====== AQUI EMPIEZA TU LOGICA ORIGINAL ======

        $context = UserContext::firstOrCreate(
            ['phone_number' => $numero],
            ['nombre' => $nombre],
            ['current_node' => 'main']
        );

        if ($context->wasRecentlyCreated) {
            $this->enviarMensajeDinamico($numero, 'main');
            return response('OK', 200);
        }

        $opcion = Option::where('chatbot_node_id', $context->current_node)
            ->where('key', $mensajeUsuario)
            ->first();

        if (!$opcion) {
            $respuestaIA = $this->funRespuestaIA($mensajeUsuario);
            $this->enviarMensajeWhatsapp($numero, [
                "type" => "text",
                "body" => $respuestaIA
            ]);

            return response('OK', 200);
        }

        if ($opcion->respuesta) {
            $this->enviarMensajeWhatsapp($numero, $opcion->respuesta);
        }

        if ($opcion->next_node_id) {
            $context->update([
                'current_node' => $opcion->next_node_id
            ]);

            $this->enviarMensajeDinamico($numero, $opcion->next_node_id);
        }

        return response('OK', 200);
    }
    /*
    public function recibirMensajeEvolution(Request $request){
        $data = $request->all();
        $msgPropio = $data['data']['key']['fromMe'];

        if ($msgPropio) return response('Mi Mensaje', 200);

        $numero =  $data['data']['key']['remoteJid'];
        $this->enviarMensajeWhatsapp($numero, ["type" => "text", "body" => "Hola Soy un Bot"]);
        return response('OK', 200);
    }
    */


    public function enviarMensajeDinamico($numero, $nodeId){
        $nodo = ChatbotNode::with('opciones')->find($nodeId);

        if(!$nodo){
            return;
        }

        $opcionesTexto = "";

        foreach($nodo->opciones as $opt){
            $opcionesTexto .= "- 👉 *{$opt->key}*: {$opt->text}\n";
        }

        $mensajeFinal = "{$nodo->mensaje}\n\n{$opcionesTexto}\n\n> *Indícanos una opción!*";
        $this->enviarMensajeWhatsapp($numero, [
            "type" => "text",
            "body" => $mensajeFinal
        ]);

    }

    public function enviarMensajeDinamicoBotones($numero, $nodeId){
        $nodo = ChatbotNode::with('opciones')->find($nodeId);

        if(!$nodo){
            return;
        }

        $buttons = [];
        foreach($nodo->opciones as $opt){
            $buttons[] = [
                "type" => "reply",
                "reply" => [
                    "id" => $opt->key,
                    "title" => substr($opt->text, 0, 20)
                ]
            ];
        }

        $payload = [
            "type" => "buttons",
            "body" => $nodo->mensaje,
            "buttons" => array_slice($buttons, 0, 3)
        ];

        $this->enviarMensajeWhatsapp($numero,$payload);

    }


    public function funRespuestaIA($mensajeUser){

        $asesores = User::get();

        $respuesta = Http::withHeaders([
            'Content-Type' => "application/json",
            'Authorization' => "Bearer ".env("TOKEN_OPENAI")
        ])->post("https://api.openai.com/v1/chat/completions", [
            "model" => "gpt-5",
            "messages" => [
                [
                    "role" => "system",
                    "content" => "Responde solamante si el cliente necesita asesoramiento por parte de nuestro personal, envia los datos de nuestro asesores si lo solicitan: esta en formato json procesalos y luego envia".$asesores
                ],
                [
                    "role" => "user",
                    "content" => $mensajeUser
                ],
                
            ]
        ]);

        return  $respuesta['choices'][0]['message']['content'];
    }
}
