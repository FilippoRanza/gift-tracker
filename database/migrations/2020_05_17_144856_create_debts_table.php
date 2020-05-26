<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('amount');

            $table->unsignedBigInteger('from_id');
            $table->foreign('from_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            
            $table->unsignedBigInteger('to_id');
            $table->foreign('to_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('debts');
    }
}
