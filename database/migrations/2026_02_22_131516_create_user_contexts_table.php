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
        Schema::create('user_contexts', function (Blueprint $table) {
            $table->id();
            $table->string("phone_number")->unique();
            $table->string("current_node")->default("main");
            $table->json("ai_history")->nullable(); // para el context de OpenAI 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_contexts');
    }
};
