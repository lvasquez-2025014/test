@extends('adminlte::page')

@section('title','Chatbot')

@section('content')

<div class="p-6">

    <h2 class="text-2xl font-bold mb-4">Nodos del Chatbot</h2>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>ID</th>
                <th>Mensaje</th>
                <th>Opciones</th>
                <th></th>
            </tr>
        </thead>

        <tbody>

            @foreach($nodes as $node)

            <tr>

                <td>{{ $node->id }}</td>

                <td>{{ $node->mensaje }}</td>

                <td>{{ $node->opciones->count() }}</td>

                <td>
                    <a href="{{ route('chatbot.show',$node->id) }}" class="btn btn-primary">
                        Editar
                    </a>
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

@stop