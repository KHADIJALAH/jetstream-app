<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // 👈 Ajouté
            $table->string('name');
            $table->string('slug')->unique()->comment('Identifiant unique SEO');
            $table->text('description');
            $table->string('location');
            $table->decimal('price', 8, 2);
            $table->unsignedInteger('duration');
            $table->string('category');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('activities');
    }
};