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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignId('id_funcionario')->constrained()->onDelete('cascade');
            $table->foreignId('id_administrador')->constrained()->onDelete('cascade');
            $table->foreignId('id_sessao')->constrained()->onDelete('cascade');
            $table->string('nome');
            $table->string('cpf');
            $table->date('dataNascimento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
