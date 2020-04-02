<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiquidationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('owner_id')->unsigned()->index();
            $table->bigInteger('event_id')->unsigned()->index();
            $table->timestamps();

            // foreign key
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('liquidations', function (Blueprint $table) {
            $table->dropForeign(['owner_id']);
            $table->dropForeign(['event_id']);
        });

        Schema::dropIfExists('liquidations');
    }
}
