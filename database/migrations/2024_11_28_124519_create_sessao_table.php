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
        Schema::create('sessao', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignId('id_funcionario')->constrained('funcionario');
            $table->double('quantidadePaga');
            $table->double('quantidadeFalta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessao');
    }
};
