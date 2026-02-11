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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name');                         // Nom du restaurant
            $table->string('cuisine_type');                 // Type de cuisine
            $table->text('address');                        // Adresse complète
            $table->string('phone');                        // Numéro de téléphone
            $table->decimal('rating', 3, 1)->nullable()->default(0); // Note moyenne
            $table->json('opening_hours')->nullable();      // Horaires d’ouverture (format JSON)
            $table->string('slug')->unique();               // Slug unique pour URL
            $table->string('image')->nullable();            // Chemin de l'image
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
