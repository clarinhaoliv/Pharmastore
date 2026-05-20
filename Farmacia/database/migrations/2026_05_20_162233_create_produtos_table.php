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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table-> foreignId('id_fornecedor')->constraint() ->cascadeOnDelete(); 
            $table->string('Nome');
            $table->float('Preço');
            $table->integer('Quantidade')->default(0);
            $table->integer('estoque_minimo')->default(5);
            $table->enum('Categoria', ['medicamento', 'perfumaria']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
