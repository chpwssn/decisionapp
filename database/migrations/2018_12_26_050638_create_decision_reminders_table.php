<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDecisionRemindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decision_reminders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('author_id');
            $table->foreign('author_id')->references('id')->on('users');
            $table->string('decision_title');
            $table->string('decision_link')->nullable();
            $table->date('reminder_date');
            $table->unsignedInteger('sent')->default(0);
            $table->unsignedInteger('skipped')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('decision_reminders');
    }
}
