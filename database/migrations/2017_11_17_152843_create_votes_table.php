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
        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('votes');
            $table->timestamps();

        });

        Schema::create('voteable', function (Blueprint $table) {
            $table->integer('vote_id');
            $table->integer('vottable_id');
            $table->string('votable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votes');
        Schema::dropIfExists('voteable');
    }
}
