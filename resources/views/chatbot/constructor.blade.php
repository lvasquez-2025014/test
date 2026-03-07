@extends('adminlte::page')

@section('title','Constructor Chatbot')

@section('content')

<script src="https://cdn.tailwindcss.com"></script>

<div class="max-w-7xl mx-auto py-10">

    <div class="flex justify-between items-center mb-8">

        <h1 class="text-3xl font-bold text-gray-800">
            🤖 Constructor de Chatbot
        </h1>

        <button onclick="openNodeModal()"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
            + Nuevo Nodo
        </button>

    </div>

    <div class="grid grid-cols-3 gap-6">

        @foreach($nodes as $node)

        <div class="bg-white rounded-xl shadow-lg border">

            <div class="bg-gray-900 text-white px-4 py-3 rounded-t-xl flex justify-between">

                <span class="font-bold">
                    Nodo: {{ $node->id }}
                </span>

                <button onclick="openOptionModal('{{ $node->id }}')"
                    class="text-xs bg-blue-500 px-2 py-1 rounded">
                    + opción
                </button>

            </div>

            <div class="p-4">

                <textarea
                    class="w-full border rounded-lg p-2 mb-4 text-sm"
                    rows="3"
                    data-node="{{ $node->id }}">{{ $node->mensaje }}</textarea>

                <div class="space-y-2">

                    @foreach($node->opciones as $op)

                    <div class="flex justify-between items-center bg-gray-50 p-2 rounded">

                        <div>

                            <span class="font-bold text-blue-600">
                                {{ $op->key }}
                            </span>

                            {{ $op->text }}

                            @if($op->next_node_id)

                            <span class="text-xs text-green-600">
                                → {{ $op->next_node_id }}
                            </span>

                            @endif

                            @if($op->respuesta)

                            <span class="text-xs text-purple-600">
                                respuesta
                            </span>

                            @endif

                        </div>

                        <form method="POST" action="/chatbot/option/{{ $op->id }}">
                            @csrf
                            @method('DELETE')

                            <button class="text-red-500 text-xs">
                                Eliminar
                            </button>

                        </form>

                    </div>

                    @endforeach

                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>


<!-- MODAL NUEVO NODO -->

<div id="nodeModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center">

    <div class="bg-white p-6 rounded-xl w-96">

        <h2 class="text-xl font-bold mb-4">Nuevo Nodo</h2>

        <form method="POST" action="/chatbot/node">

            @csrf

            <input name="id"
                placeholder="ID nodo"
                class="w-full border p-2 rounded mb-3">

            <textarea name="mensaje"
                placeholder="Mensaje"
                class="w-full border p-2 rounded mb-3"></textarea>

            <button class="bg-blue-600 text-white px-4 py-2 rounded w-full">
                Crear
            </button>

        </form>

    </div>

</div>


<!-- MODAL NUEVA OPCION -->

<div id="optionModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center">

    <div class="bg-white p-6 rounded-xl w-96">

        <h2 class="text-xl font-bold mb-4">Nueva Opción</h2>

        <form method="POST" action="/chatbot/option">

            @csrf

            <input type="hidden" name="node_id" id="node_id">

            <input name="key"
                placeholder="Tecla (A,1)"
                class="w-full border p-2 rounded mb-3">

            <input name="text"
                placeholder="Texto opción"
                class="w-full border p-2 rounded mb-3">

            <input name="next_node_id"
                placeholder="Nodo siguiente"
                class="w-full border p-2 rounded mb-3">

            <select name="respuesta_tipo"
                class="w-full border p-2 rounded mb-3">

                <option value="">Sin respuesta</option>
                <option value="text">Texto</option>

            </select>

            <textarea name="respuesta_texto"
                placeholder="Respuesta"
                class="w-full border p-2 rounded mb-3"></textarea>

            <button class="bg-green-600 text-white px-4 py-2 rounded w-full">
                Crear opción
            </button>

        </form>

    </div>

</div>


<script>
    function openNodeModal() {

        document.getElementById('nodeModal').classList.remove('hidden')

    }

    function openOptionModal(node) {

        document.getElementById('node_id').value = node
        document.getElementById('optionModal').classList.remove('hidden')

    }
</script>

@stop