<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom de l'utilisateur
            $table->string('email')->unique(); // Adresse email unique
            $table->string('password'); // Mot de passe
            $table->timestamps(); // Horodatage de création et de mise à jour
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
