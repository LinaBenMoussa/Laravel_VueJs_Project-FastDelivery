<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEtatToCommandeTable extends Migration
{
    public function up()
    {
        Schema::table('commande', function (Blueprint $table) {
            $table->string('etat')->default('en_cours'); // Vous pouvez ajuster la valeur par défaut si nécessaire
        });
    }

    public function down()
    {
        Schema::table('commande', function (Blueprint $table) {
            $table->dropColumn('etat');
        });
    }
}
?>