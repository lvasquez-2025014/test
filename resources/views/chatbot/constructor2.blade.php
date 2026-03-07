@extends('adminlte::page')

@section('title','Constructor PRO Chatbot')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/drawflow/dist/drawflow.min.css">

<script src="https://cdn.jsdelivr.net/npm/drawflow/dist/drawflow.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>

<div class="flex h-screen">

    <!-- PANEL IZQUIERDO -->

    <div class="w-72 bg-gray-900 text-white p-4">

        <h2 class="text-xl font-bold mb-4">
            🤖 Chatbot Builder
        </h2>

        <button onclick="addNode()"
            class="bg-blue-500 w-full py-2 rounded mb-3">
            + Nodo
        </button>

        <button onclick="previewBot()"
            class="bg-green-500 w-full py-2 rounded">
            Preview
        </button>
        <h3 class="font-bold mt-4 mb-2">Agregar opción</h3>
        <input id="opt_key" placeholder="Tecla (A,1)" class="w-full border p-2 rounded mb-2">
        <input id="opt_text" placeholder="Texto opción" class="w-full border p-2 rounded mb-2">
        <input id="opt_next" placeholder="Nodo siguiente" class="w-full border p-2 rounded mb-2">
        <button onclick="addOption()" class="bg-green-600 text-white px-4 py-2 rounded w-full">
            Agregar opción
        </button>

    </div>


    <!-- AREA DIAGRAMA -->

    <div id="drawflow" class="flex-1 bg-gray-100"></div>


    <!-- PANEL DERECHO -->

    <div class="w-80 bg-white border-l p-4">

        <h3 class="font-bold text-lg mb-4">
            Editor de Nodo
        </h3>

        <input id="node_id"
            class="w-full border p-2 rounded mb-3"
            placeholder="ID nodo">

        <textarea id="node_message"
            class="w-full border p-2 rounded mb-3"
            rows="4"
            placeholder="Mensaje"></textarea>

        <button onclick="saveNode()"
            class="bg-blue-600 text-white px-4 py-2 rounded w-full">
            Guardar
        </button>

    </div>

</div>


<!-- PREVIEW -->

<div id="preview"
    class="hidden fixed bottom-4 right-4 w-80 bg-white shadow-xl rounded-xl">

    <div class="bg-blue-600 text-white p-3 rounded-t-xl">

        Chatbot Preview

    </div>

    <div id="chat_body"
        class="p-3 h-64 overflow-y-auto text-sm">
    </div>

    <input id="chat_input"
        class="w-full border-t p-2"
        placeholder="Escribe una opción">

</div>



<script>
    const editor = new Drawflow(document.getElementById("drawflow"))

    editor.start()

    let nodes = @json($nodes)


    /* Cargar nodos */

    nodes.forEach(node => {

        editor.addNode(

            node.id,
            1,
            1,
            200,
            200,
            'class-node', {
                id: node.id,
                message: node.mensaje
            },
            `
<div class="bg-white border rounded-lg p-3 shadow">

<div class="font-bold text-blue-600">
${node.id}
</div>

<div class="text-xs text-gray-500">
${node.mensaje}
</div>

</div>
`

        )

    })


    /* Seleccionar nodo */

    editor.on('nodeSelected', function(id) {

        let node = editor.getNodeFromId(id)

        document.getElementById("node_id").value = node.data.id
        document.getElementById("node_message").value = node.data.message

    })


    /* Guardar nodo AJAX */

    function saveNode() {

        let id = document.getElementById("node_id").value
        let message = document.getElementById("node_message").value

        fetch("/chatbot/node/update", {

                method: "POST",

                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },

                body: JSON.stringify({
                    id: id,
                    mensaje: message
                })

            })
            .then(r => r.json())
            .then(() => {

                alert("Nodo guardado")

            })

    }


    /* Crear nodo */

    function addNode() {

        let id = prompt("ID nodo")

        editor.addNode(

            id,
            1,
            1,
            300,
            200,
            'class-node', {
                id: id,
                message: "Nuevo mensaje"
            },
            `
<div class="bg-white border rounded-lg p-3 shadow">

<div class="font-bold text-blue-600">
${id}
</div>

<div class="text-xs">
Nuevo mensaje
</div>

</div>
`

        )

    }


    /* Preview chatbot */

    function previewBot() {

        document.getElementById("preview").classList.remove("hidden")

        startChat()

    }


    function startChat() {

        let main = nodes.find(n => n.id === "main")

        let chat = document.getElementById("chat_body")

        chat.innerHTML = "<div>" + main.mensaje + "</div>"

    }
</script>

@stop