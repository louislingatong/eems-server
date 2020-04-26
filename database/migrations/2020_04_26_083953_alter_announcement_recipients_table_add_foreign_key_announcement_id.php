<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAnnouncementRecipientsTableAddForeignKeyAnnouncementId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('announcement_recipients', function (Blueprint $table) {
            $table->foreign('announcement_id')
                ->references('id')
                ->on('announcements')
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
        Schema::table('announcement_recipients', function (Blueprint $table) {
            $table->dropForeign(['announcement_id']);
        });
    }
}
