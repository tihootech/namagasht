<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('uid')->unique();
            $table->boolean('hidden_inputs')->default(0);
            $table->unsignedSmallInteger('theme')->default(0);
            $table->string('bg_image')->nullable();
            $table->boolean('finish_answering')->default(0);
            $table->date('auto_finish_date')->nullable();
            $table->boolean('no_back')->default(0);
            $table->boolean('no_next')->default(0);
            $table->boolean('no_progress_bar')->default(0);
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
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
        Schema::dropIfExists('forms');
    }
}
