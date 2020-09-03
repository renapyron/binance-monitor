<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EndpointTimestampsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('endpoint_timestamps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('endpoint');
            $table->string('method');
            $table->timestamp('last_call', 0)->nullable();

            $table->index('endpoint');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('endpoint_timestamps');
    }
}
