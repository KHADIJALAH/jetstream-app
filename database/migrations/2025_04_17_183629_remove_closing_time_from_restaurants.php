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
        Schema::table('restaurants', function (Blueprint $table) {
            // Supprimez les colonnes obsolètes
            if (Schema::hasColumn('restaurants', 'closing_time')) {
                $table->dropColumn('closing_time');
            }
            if (Schema::hasColumn('restaurants', 'opening_time')) {
                $table->dropColumn('opening_time');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            //
        });
    }
};
