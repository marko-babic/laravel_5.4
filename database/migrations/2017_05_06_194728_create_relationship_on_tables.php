<?php

use Illuminate\Database\Migrations\Migration;

class CreateRelationshipOnTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('description_id')->references('id')->on('navbar');
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->foreign('topic_id')->references('id')->on('topics');
            $table->foreign('status_id')->references('id')->on('ticket_status');
        });

        Schema::table('ticket_replies', function (Blueprint $table) {
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->foreign('ticket_id')->references('id')->on('tickets');
        });

        Schema::table('screenshots', function (Blueprint $table) {
            $table->foreign('account_id')->references('id')->on('accounts');
        });

        Schema::table('screenshot_votes', function (Blueprint $table) {
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->foreign('screenshot_id')->references('id')->on('screenshots');
        });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
