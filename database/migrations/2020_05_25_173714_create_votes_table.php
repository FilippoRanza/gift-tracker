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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('list_id');
            $table->foreign('list_id')->references('id')->on('gift_lists')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('user');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

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
    }
}
