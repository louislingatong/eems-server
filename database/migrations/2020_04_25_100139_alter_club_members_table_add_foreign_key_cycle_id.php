<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterClubMembersTableAddForeignKeyCycleId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('club_members', function (Blueprint $table) {
            $table->foreign('cycle_id')
                ->references('id')
                ->on('cycles')
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
        Schema::table('club_members', function (Blueprint $table) {
            $table->dropForeign(['cycle_id']);
        });
    }
}
