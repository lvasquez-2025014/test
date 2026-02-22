<?php

namespace Database\Seeders;

use App\Models\ChatbotNode;
use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChatbotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChatbotNode::create([
            "id" => "main",
            "mensaje" => "*Bienvenido al Banco Crédito Seguro* \n\nSeleccione una *opción* para continuar"
        ]);

        // Opciones
        Option::create([
            'chatbot_node_id' => 'main',
            'key' => 'A',
            'text' => "Lista Préstamos",
            'next_node_id' => 'prestamos'
        ]);

        Option::create([
            'chatbot_node_id' => 'main',
            'key' => 'B',
            'text' => "Nuestras Sucursales",
            'respuesta' => [
                'type' => 'location',
                'latitude' => '-16.5654',
                'longitude' => '-68.15654',
                'name' => 'Centro de la ciudad',
                'address' => 'Av. 6 de Agosto',
            ]
        ]);

        ChatbotNode::create([
            "id" => "prestamos",
            "mensaje" => "*Tipos de Prestamos* \n\nSeleccione una *opción*"
        ]);

        Option::create([
            'chatbot_node_id' => 'prestamos',
            'key' => '1',
            'text' => "Préstamos hipoteca",
            'respuesta' => [
                'type' => 'text',
                'body' => "Hasta 20 Años de plazo\nTasas desde 6.5%"
            ]
        ]);

        Option::create([
            'chatbot_node_id' => 'prestamos',
            'key' => '2',
            'text' => "Volver",
            'next_node_id' => 'main'
        ]);

    }
}
