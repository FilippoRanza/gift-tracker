<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPollFlagToGiftLists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gift_lists', function (Blueprint $table) {
            $table->boolean('poll')->default(false);
            $table->boolean('ready')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gift_lists', function (Blueprint $table) {
            $table->dropColumn('poll');
            $table->dropColumn('ready');
        });
    }
}
