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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('direccio');
            $table->unsignedBigInteger('ciutat_id');
            $table->string('telefon');
            $table->string('email');
            $table->string('identificadorHotel');
            $table->timestamps();

            $table->foreign('ciutat_id')->references('id')->on('ciutats')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
