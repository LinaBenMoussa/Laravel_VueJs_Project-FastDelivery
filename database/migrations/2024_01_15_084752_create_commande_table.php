<?php
// database/migrations/{timestamp}_create_commande_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeTable extends Migration
{
    public function up()
    {
        Schema::create('commande', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->unsignedBigInteger('food_id');
            $table->integer('qty');
            $table->foreign('food_id')->references('id')->on('foods');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('commande');
    }
}
?>