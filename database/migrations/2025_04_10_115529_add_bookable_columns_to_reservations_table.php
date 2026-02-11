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
    Schema::table('reservations', function (Blueprint $table) {
        $table->string('bookable_type')->nullable(); // e.g. App\Models\Hotel
        $table->unsignedBigInteger('bookable_id')->nullable(); // e.g. 1
        
        // Add index for better performance
        $table->index(['bookable_type', 'bookable_id']);
    });
}

public function down()
{
    Schema::table('reservations', function (Blueprint $table) {
        $table->dropColumn(['bookable_type', 'bookable_id']);
    });
}
    };
