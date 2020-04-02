<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEmployeeEventsTableDropForeignKeysOnRollback extends Migration
{
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_events', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropForeign(['employee_id']);
        });
    }
}
