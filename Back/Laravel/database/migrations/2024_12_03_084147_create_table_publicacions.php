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
            $table->foreignId('id_usuari')->references('id')->on('usuaris')->onDelete('cascade');
            $table->string('titol', 100);
            $table->string('especialitat');
            $table->text('contingut');
            $table->date('data_publicacio');
            $table->string('hora_inici');
            $table->string('hora_final');
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
