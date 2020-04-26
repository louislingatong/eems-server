<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventLiquidationExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_liquidation_expenses', function (Blueprint $table) {
            $table->id();
            $table->string('particulars');
            $table->decimal('amount');
            $table->dateTime('issue_date');
            $table->bigInteger('liquidation_id')->unsigned()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_liquidation_expenses');
    }
}
