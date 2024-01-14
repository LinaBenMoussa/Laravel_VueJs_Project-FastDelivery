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
            // Ajoutez les colonnes avec la possibilité d'être null
            $table->string('secretCode')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservation_tables', function (Blueprint $table) {
            // Supprimez les colonnes lors du rollback
            $table->dropColumn(['secretCode', 'email', 'phone']);
        });
    }
};
