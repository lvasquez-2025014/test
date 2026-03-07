@extends('adminlte::page')

@section('title', 'Mis Contactos')

@section('content_header')
<h1>Mis Contactos</h1>
@stop

@section('content')

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Contactos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen">

    <div class="max-w-7xl mx-auto p-8">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-bold text-gray-800">📋 Lista de Contactos</h1>
                <p class="text-gray-500 mt-1">Gestiona y envía mensajes fácilmente</p>
            </div>

            <div class="bg-white px-5 py-3 rounded-xl shadow-md">
                <span class="text-gray-600 text-sm">Total contactos</span>
                <p class="text-2xl font-bold text-blue-600">1</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-600">

                    <thead class="bg-gray-900 text-white uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Nombre</th>
                            <th class="px-6 py-4">Número</th>
                            <th class="px-6 py-4">Mensaje</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @foreach($contactos as $cont)

                        <tr class="hover:bg-gray-50 transition duration-200">

                            <td class="px-6 py-6 font-semibold text-gray-800">
                                {{ $cont->id }}
                            </td>

                            <td class="px-6 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">
                                        C
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $cont->nombre }}</p>
                                        <p class="text-xs text-gray-400">Contacto activo</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-6">
                                <span class="px-3 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">
                                    {{ $cont->phone_number }}
                                </span>
                            </td>

                            <td class="px-6 py-6 w-[400px]">

                                <form action="/api/enviar-mensaje" method="post" class="space-y-3 form-enviar">

                                    @csrf

                                    <input type="hidden" value="{{ $cont->phone_number }}" name="numero">
                                    <input type="hidden" value="text" name="mensaje[type]">

                                    <textarea
                                        name="mensaje[body]"
                                        rows="3"
                                        class="w-full border border-gray-300 rounded-xl p-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none resize-none transition"
                                        placeholder="Escribe tu mensaje aquí..."></textarea>

                                    <div class="flex justify-end">
                                        <button
                                            type="submit"
                                            class="bg-blue-600 hover:bg-blue-700 active:scale-95 text-white px-5 py-2 rounded-xl shadow-md transition duration-200">
                                            🚀 Enviar Mensaje
                                        </button>
                                    </div>

                                </form>

                            </td>

                        </tr>

                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>

        <div class="mt-6 text-center text-gray-400 text-sm">
            Sistema de gestión de contactos © 2026
        </div>

    </div>

    <script>
        document.querySelectorAll('.form-enviar').forEach(form => {

            form.addEventListener('submit', function(e) {

                e.preventDefault()

                let formData = new FormData(this)

                fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {

                        alert('Mensaje enviado correctamente')

                        // this.querySelector('textarea').value = ''

                    })
                    .catch(err => {
                        alert('Error al enviar mensaje')
                    })

            })

        })
    </script>

</body>

</html>

@stop