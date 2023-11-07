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
        Schema::create('brinquedo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->nullable('false');
            $table->string('nome', 80)->nullable('false');
            $table->string('descricao', 160)->nullable('true');
            $table->integer('capacidade')->nullable('true');
            $table->decimal('valor_ingresso', 10,2)->nullable('false');
            $table->enum('status_funcionamento', ['ATIVO', 'MANUTENÇÃO','INATIVO'])->nullable('false');
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brinquedo');
    }
};
