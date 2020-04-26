<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClubMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('club_members', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cycle_id')->unsigned()->index();
            $table->bigInteger('club_id')->unsigned()->index();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('club_members');
    }
}
