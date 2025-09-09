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
        Schema::create('saved_lists', function (Blueprint $table) {
            $table->id(); // Uniek ID voor elke playlist
            $table->string('name'); // Naam van de playlist (verzonnen door gebruiker)
            $table->foreignId('user_id') // Verwijzing naar de gebruiker die deze lijst heeft gemaakt
                  ->constrained()        // Verbindt automatisch met de 'users' tabel
                  ->onDelete('cascade'); // Verwijder alle playlists als de user wordt verwijderd
            $table->timestamps(); // created_at en updated_at kolommen
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_lists');
    }
};