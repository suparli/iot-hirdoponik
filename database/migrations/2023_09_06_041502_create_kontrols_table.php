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
        Schema::create('kontrols', function (Blueprint $table) {
            $table->id();
            $table->integer('device_id');
            $table->string('interval', 10);
            $table->boolean('pompa_ph');
            $table->boolean('pompa_ec');
            $table->boolean('mode');
            $table->string('ba_ph', 10);
            $table->string('bb_ph', 10);
            $table->string('ba_ec', 10);
            $table->string('bb_ec', 10);
            $table->datetime('device_time');
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
        Schema::dropIfExists('kontrols');
    }
};
