<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiquidationExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidation_expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('particulars');
            $table->decimal('amount');
            $table->dateTime('issue_date');
            $table->bigInteger('liquidation_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('liquidation_id')->references('id')->on('liquidations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('liquidation_expenses', function (Blueprint $table) {
            $table->dropForeign(['liquidation_id']);
        });

        Schema::dropIfExists('liquidation_expenses');
    }
}
