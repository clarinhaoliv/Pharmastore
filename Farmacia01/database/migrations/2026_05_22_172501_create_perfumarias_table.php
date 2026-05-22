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
        Schema::create('perfumarias', function (Blueprint $table) {
            $table->id();
            $table-> foreignId('id_produto')->constraint() ->cascadeOnDelete(); 
            $table->string('lote_fabricacao');
            $table->date('data_validade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfumarias');
    }
};
