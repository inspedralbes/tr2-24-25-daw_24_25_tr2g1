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
        Schema::create('alumnes', function (Blueprint $table) {
            $table->id('id_alumne');
            $table->unsignedBigInteger('id_usuari');
            $table->string('curs');
            $table->string('classe');
            $table->foreign('id_usuari')->references('id')->on('usuaris')->onDelete('cascade');     
            $table->timestamps();
      
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnes');
    }
};
