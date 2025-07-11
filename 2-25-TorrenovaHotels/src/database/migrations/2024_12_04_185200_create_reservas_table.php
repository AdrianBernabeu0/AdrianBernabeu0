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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('habitacion_id')->nullable();
            $table->dateTime('data_Entrada');
            $table->dateTime('data_Sortida');
            $table->boolean('check_in');
            $table->boolean('check_out');
            $table->double('preu');
            $table->enum('estat', ['Reserva confirmada', 'Pagada']);
            $table->integer("persones_reserva");
            $table->unsignedBigInteger('usuari_id')->nullable();
            $table->foreign('habitacion_id')->references('id')->on('habitacions')->onDelete('cascade');
            $table->foreign('usuari_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
