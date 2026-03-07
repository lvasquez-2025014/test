@extends('adminlte::page')

@section('title','Editar Nodo')

@section('content')

<div class="p-6">

    <h2 class="text-2xl font-bold mb-4">
        Nodo: {{ $node->id }}
    </h2>

    <form method="POST" action="{{ route('chatbot.node.update',$node->id) }}">

        @csrf
        @method('PUT')

        <textarea name="mensaje" class="form-control mb-3">
        {{ $node->mensaje }}
        </textarea>

        <button class="btn btn-success">
            Actualizar mensaje
        </button>

    </form>

    <hr class="my-5">

    <h3 class="text-xl font-bold mb-3">
        Opciones
    </h3>

    @foreach($node->opciones as $option)

    <div class="border p-3 mb-2">

        <strong>{{ $option->key }}</strong>
        - {{ $option->text }}

        <form method="POST" action="{{ route('chatbot.option.delete',$option->id) }}">

            @csrf
            @method('DELETE')

            <button class="btn btn-danger btn-sm">
                Eliminar
            </button>

        </form>

    </div>

    @endforeach


    <hr class="my-5">

    <h3 class="text-xl font-bold mb-3">
        Nueva opción
    </h3>

    <form method="POST" action="{{ route('chatbot.option.store') }}">

        @csrf

        <input type="hidden" name="node_id" value="{{ $node->id }}">

        <input class="form-control mb-2" name="key" placeholder="Tecla (A, B, 1, 2...)">

        <input class="form-control mb-2" name="text" placeholder="Texto opción">

        <select class="form-control mb-2" name="next_node_id">

            <option value="">Respuesta directa</option>

            @foreach($nodes as $n)

            <option value="{{ $n }}">{{ $n }}</option>

            @endforeach

        </select>

        <select name="respuesta_tipo" class="form-control mb-2">
            <option value="">Sin respuesta</option>
            <option value="text">Texto</option>
        </select>

        <textarea class="form-control mb-2" name="respuesta_texto" placeholder="Texto respuesta"></textarea>

        <button class="btn btn-primary">
            Crear opción
        </button>

    </form>

</div>

@stop