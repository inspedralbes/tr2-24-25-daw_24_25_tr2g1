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
        Schema::create('publicacions', function (Blueprint $table) {
            $table->id();
            $table->string('titol', 100);
            $table->text('contingut');
            // $table->string('imatge')->nullable();
            $table->foreignId('id_usuari')->references('id')->on('usuaris')->onDelete('cascade');
            $table->enum('estat', ['activa', 'inactiva']);
            $table->enum('especialitat', ['Matemáticas', 'Inglés', 'Ciencias','Biologia', 'Pogramacio','Geografia','Tecnologia','Quimica']);
            //$table->timestamp('publicacio_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publicacions');
    }
};
