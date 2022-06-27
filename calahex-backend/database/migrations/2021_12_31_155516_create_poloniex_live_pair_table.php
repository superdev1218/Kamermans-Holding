<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoloniexLivePairTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poloniex_live_pair', function (Blueprint $table) {
            $table->id();
            $table->string('pair')->nullable();
            $table->bigInteger('pair_id')->nullable()->comment('poloniex pair id');
            $table->string('last')->nullable()->comment('last is last traded price of the pair');
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
        Schema::dropIfExists('poloniex_live_pair');
    }
}
