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
        Schema::create('saved_list_song', function (Blueprint $table) {
            $table->id();

            // Verwijzing naar saved_list (playlist)
            $table->foreignId('saved_list_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Verwijzing naar song
            $table->foreignId('song_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_list_song');
    }
};