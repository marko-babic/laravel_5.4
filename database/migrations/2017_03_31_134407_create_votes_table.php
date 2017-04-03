<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->integer('screenshot_id');
            $table->integer('account_id');
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
