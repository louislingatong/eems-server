<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEventLiquidationExpensesTableAddForeignKeyLiquidationId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_liquidation_expenses', function (Blueprint $table) {
            $table->foreign('liquidation_id')
                ->references('id')
                ->on('event_liquidations')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_liquidation_expenses', function (Blueprint $table) {
            $table->dropForeign(['liquidation_id']);
        });
    }
}
