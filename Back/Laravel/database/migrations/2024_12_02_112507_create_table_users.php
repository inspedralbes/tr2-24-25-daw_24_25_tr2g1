<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuaris', function (Blueprint $table) {
            $table->id('id');
            $table->string('nom', 100);
            $table->string('cognom1', 100);
            $table->string('cognom2', 100);
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->enum('rol', ['alumne', 'mentor', 'professor']);
            $table->date('data_naixement')->nullable();
            $table->string('telefon', 9)->nullable();
            $table->string('foto_profile')->nullable();
            $table->text('biografia')->nullable();
            $table->enum('major', ['si', 'no']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuaris');
    }
};
