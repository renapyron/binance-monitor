<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AssetPairStats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('asset_pair_stats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('asset_bought');
            $table->string('asset_sold');
            $table->decimal('average_buy', 18, 6)->default(0);
            $table->decimal('average_sell', 18, 6)->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->index('asset_bought');
            $table->index('asset_sold');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('asset_pair_stats');
    }
}
