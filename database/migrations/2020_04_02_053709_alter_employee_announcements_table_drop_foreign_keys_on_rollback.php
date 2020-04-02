<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEmployeeAnnouncementsTableDropForeignKeysOnRollback extends Migration
{
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_announcements', function (Blueprint $table) {
            $table->dropForeign(['announcement_id']);
            $table->dropForeign(['employee_id']);
        });
    }
}
