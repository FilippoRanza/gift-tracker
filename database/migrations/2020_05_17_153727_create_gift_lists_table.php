<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_lists', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->boolean('done');
            $table->unsignedBigInteger('buyer')->nullable();
            
            $table->unsignedBigInteger('owner');
            $table->foreign('owner')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->boolean('guest_only');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gift_lists');
    }
}
