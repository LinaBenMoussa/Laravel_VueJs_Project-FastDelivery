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
        Schema::table('reservation_tables', function (Blueprint $table) {
            $table->integer('numpersonnes')->nullable(); // Ajout de la colonne numpersonnes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservation_tables', function (Blueprint $table) {
            $table->dropColumn('numpersonnes'); // Suppression de la colonne numpersonnes lors du rollback
        });
    }
};
