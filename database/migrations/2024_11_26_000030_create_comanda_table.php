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
        Schema::create('comanda', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuari_id')
            ->constrained(table:'users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('data_comanda');
            $table->enum('estat', ['processat','pendent','entregat'])->default('pendent');
            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comanda');
    }
};
