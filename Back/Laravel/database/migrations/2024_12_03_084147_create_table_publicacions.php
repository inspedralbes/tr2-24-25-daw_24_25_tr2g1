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
            $table->id('id_publicacio');
            $table->string('titol', 100);
            $table->text('contingut');
            $table->string('imatge')->nullable();
            $table->foreignId('id_usuari')->references('id')->on('usuaris')->onDelete('cascade');
            $table->enum('estat', ['activa', 'inactiva']);
            $table->integer('views_count')->default(0);
            $table->timestamp('publlicacio_data')->nullable();
            $table->string('horainici');
            $table->string('horafi');
            $table->date('dia');
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
