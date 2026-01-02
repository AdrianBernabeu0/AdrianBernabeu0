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
        Schema::create('habitacions', function (Blueprint $table) {
            $table->id();
            $table->integer('nom');
            $table->integer('llit');
            $table->integer('llit_extra');
            $table->integer('ocupants_habitacio');
            $table->enum('estat', ['ocupat', 'lliure','bloquejat']);
            $table->json('imatge');
            $table->string('observation');
            $table->unsignedBigInteger('tipus_habitacions_id');
            $table->unsignedBigInteger('hotel_id');
            $table->timestamps();
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->foreign('tipus_habitacions_id')->references('id')->on('tipus_habitacions')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habitacions');
    }
};
