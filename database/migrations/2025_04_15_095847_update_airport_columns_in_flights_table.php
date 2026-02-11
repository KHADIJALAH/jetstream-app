<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('flights', function (Blueprint $table) {
            $table->string('departure_airport', 255)->change();
            $table->string('arrival_airport', 255)->change();
        });
    }
    
    public function down()
    {
        Schema::table('flights', function (Blueprint $table) {
            $table->string('departure_airport', 4)->change();
            $table->string('arrival_airport', 4)->change();
        });
    }
};
