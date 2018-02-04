<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_routes', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('route')->index();
            $table->unsignedInteger('bus_id')->index();
            $table->unsignedInteger('bus_stop_id')->index();
            $table->timestamps();
        });

        Schema::table('bus_routes', function (Blueprint $table) {
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');
            $table->foreign('bus_stop_id')->references('id')->on('bus_stops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bus_routes');
    }
}
