<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRestaurantIdToReservationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservation_tables', function (Blueprint $table) {
            $table->unsignedBigInteger('restaurant_id')->after('table_id');
            $table->foreign('restaurant_id')->references('id')->on('restaurants'); // Remplacez 'restaurants' par le nom de votre table des restaurants
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservation_tables', function (Blueprint $table) {
            $table->dropColumn('restaurant_id');
        });
    }
}
?>