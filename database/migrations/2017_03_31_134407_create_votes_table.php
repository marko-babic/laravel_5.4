<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screenshot_votes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('screenshot_id');
            $table->unsignedInteger('account_id');
            $table->timestamps();
            $table->unique(['screenshot_id', 'account_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('screenshot_votes');
    }
}
