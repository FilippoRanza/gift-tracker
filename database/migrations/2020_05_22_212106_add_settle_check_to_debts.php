<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSettleCheckToDebts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('debts', function (Blueprint $table) {
            $table->boolean('confirm_settle')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('debts', function (Blueprint $table) {
            $table->dropColumn('confirm_settle');
        });
    }
}
