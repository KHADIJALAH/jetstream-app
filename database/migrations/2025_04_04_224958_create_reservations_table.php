<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom de l'hôtel
            $table->string('location'); // Localisation de l'hôtel
            $table->text('description'); // Description de l'hôtel
            $table->decimal('rating', 3, 2); // Note sur 5
            $table->timestamps(); // Horodatage
        });
    }

    public function down()
    {
        Schema::dropIfExists('hotels');
    }
}