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
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('name');       // Naam van het liedje
            $table->string('artist');     // Artiest of band
            $table->string('duration');   // Duur van het liedje
            $table->foreignId('genre_id') // Verwijst naar genre tabel
                ->constrained()
                ->onDelete('cascade');
            $table->timestamps();         // Laravel timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
