<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loggings', function (Blueprint $table) {
            $table->id();
            $table->integer('device_id');
            $table->datetime('device_time');
            $table->string('water_level',10);
            $table->boolean('pompa_ph');
            $table->boolean('pompa_ec');
            $table->string('temperature', 10);
            $table->string('humidity', 10);
            $table->string('ph', 10);
            $table->string('ec', 10);
            $table->string('tds', 10);
            $table->string('water_temp', 10);
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
        Schema::dropIfExists('loggings');
    }
};
