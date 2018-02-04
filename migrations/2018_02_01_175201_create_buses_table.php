<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');

            # we need to use string since not all buses has an integer value
            $table->string('bus_number')->index();

            $table->timestamps();
        });

        Schema::table('bus_services', function (Blueprint $table) {
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');
        });

        Schema::table('bus_stop_services', function (Blueprint $table) {
            $table->foreign('bus_stop_id')->references('id')->on('bus_stops')->onDelete('cascade');
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bus_services', function (Blueprint $table) {
            $table->dropForeign(['bus_id']);
        });

        Schema::table('bus_stop_services', function (Blueprint $table) {
            $table->dropForeign(['bus_stop_id']);
            $table->dropForeign(['bus_id']);
        });

        Schema::dropIfExists('buses');
    }
}
