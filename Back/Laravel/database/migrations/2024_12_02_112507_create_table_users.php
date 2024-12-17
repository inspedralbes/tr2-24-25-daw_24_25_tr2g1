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
            $table->string('password', 60);
            $table->enum('rol', ['alumne', 'mentor', 'professor'])->default('alumne');
            $table->string('correu')->unique();
            $table->string('correualternatiu')->unique();
            $table->enum('pregunta_secreta',['Quin és nom del teu primer amic?','On vas fer la ESO?','Quin és el teu cotxe preferit?']);
            $table->string('resposta_secreta');
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
