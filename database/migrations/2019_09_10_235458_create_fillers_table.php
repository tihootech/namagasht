<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFillersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fillers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('form_id');
            $table->string('uid');
            $table->string('client_ip');
            $table->string('device');
            $table->unsignedInteger('time')->nullable();
            $table->dateTime('finished_at')->nullable();
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
        Schema::dropIfExists('fillers');
    }
}
