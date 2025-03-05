<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::create('serveis', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'nom');
            $table->string(column: 'descripcio');
            $table->unsignedBigInteger('habitacion_id');

            $table->timestamps();

            $table->foreign('habitacion_id')->references('id')->on('habitacions')->onDelete('cascade');

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('serveis');
    }
};
