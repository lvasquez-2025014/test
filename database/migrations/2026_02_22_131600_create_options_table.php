<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->string("chatbot_node_id"); // relacion con el nodo
            $table->string("key"); // A, B, C, D
            $table->string("text"); // Texto de la opción
            $table->string("respuesta")->nullable(); // El objeto JSON de respuesta
            $table->string("next_node_id")->nullable(); // A qué nodo salta

            $table->foreign("chatbot_node_id")->references("id")->on("chatbot_nodes");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
