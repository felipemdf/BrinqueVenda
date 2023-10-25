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
        Schema::create('venda', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brinquedo_id')->nullable('false');
            $table->integer('quantidade_ingressos')->nullable('false');
            $table->string('cpf', 11)->nullable('true');
            $table->enum('forma_pagamento', ['DINHEIRO', 'PIX', 'DEBITO', 'CREDITO'])->nullable('false');
            $table->timestamps();

            $table->foreign('brinquedo_id')->references('id')->on('brinquedo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venda');
    }
};
