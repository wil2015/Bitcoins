<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historical', function (Blueprint $table) {
            //

            $table->bigIncrements('id')->index();
            $table->float('value', 8, 2);
            $table->char('operation'); 
            $table->biginteger('account_id')->unsigned();;
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->biginteger("user_id")-> unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('historical', function (Blueprint $table) {
            //
        });
    }
}
