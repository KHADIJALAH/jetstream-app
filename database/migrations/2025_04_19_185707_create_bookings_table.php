<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{

    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->dateTime('start_date');
            $table->unsignedInteger('participants');
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
            
            $table->index('activity_id'); // Ajouté pour les performances
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}


