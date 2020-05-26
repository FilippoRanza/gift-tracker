<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOptionalRecipientFieldToGiftLists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gift_lists', function (Blueprint $table) {
            $table->boolean('has_recipient')->default(false);
            $table->string('recipient')->default("");
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
            $table->dropColumn('has_recipient');
            $table->dropColumn('recipient');
        });
    }
}
