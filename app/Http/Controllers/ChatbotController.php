<?php

namespace App\Http\Controllers;

use App\Models\ChatbotNode;
use App\Models\Option;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function index()
    {
        $nodes = ChatbotNode::with('opciones')->get();

        return view('chatbot.index', compact('nodes'));
    }


    public function show($id)
    {
        $node = ChatbotNode::with('opciones')->findOrFail($id);

        $nodes = ChatbotNode::pluck('id');

        return view('chatbot.show', compact('node', 'nodes'));
    }


    public function storeNode(Request $request)
    {
        ChatbotNode::create([
            'id' => $request->id,
            'mensaje' => $request->mensaje
        ]);

        return redirect()->back();
    }


    public function updateNode(Request $request, $id)
    {
        $node = ChatbotNode::findOrFail($id);

        $node->update([
            'mensaje' => $request->mensaje
        ]);

        return redirect()->back();
    }


    public function storeOption(Request $request)
    {
        $request->validate([
            'node_id' => 'required',
            'key' => 'required',
            'text' => 'required'
        ]);

        $respuesta = null;

        if ($request->respuesta_tipo == "text") {
            $respuesta = [
                "type" => "text",
                "body" => $request->respuesta_texto
            ];
        }

        Option::create([
            'chatbot_node_id' => $request->node_id,
            'key' => $request->key,
            'text' => $request->text,
            'next_node_id' => $request->next_node_id,
            'respuesta' => $respuesta
        ]);

        return redirect()->back();
    }


    public function deleteOption($id)
    {
        Option::findOrFail($id)->delete();

        return redirect()->back();
    }

    public function constructor()
    {
        $nodes = ChatbotNode::with('opciones')->get();

        return view('chatbot.constructor', compact('nodes'));
    }

    public function constructor2()
    {
        $nodes = ChatbotNode::with('opciones')->get();

        return view('chatbot.constructor2', compact('nodes'));
    }

    public function updateNode2(Request $request)
    {

        $node = ChatbotNode::find($request->id);

        $node->mensaje = $request->mensaje;

        $node->save();

        return response()->json([
            "ok" => true
        ]);
    }
}
