<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// Dans le fichier de migration
public function up()
{
    Schema::table('restaurants', function (Blueprint $table) {
        // Supprimer UNIQUEMENT si la colonne existe
        if (Schema::hasColumn('restaurants', 'opening_time')) {
            $table->dropColumn('opening_time');
        }
        if (Schema::hasColumn('restaurants', 'closing_time')) {
            $table->dropColumn('closing_time');
        }
    });
}

public function down()
{
    Schema::table('restaurants', function (Blueprint $table) {
        $table->dropColumn('opening_hours');
        $table->string('opening_time')->nullable();
    });
}
};
