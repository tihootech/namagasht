<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('form_id');
            $table->string('type');
            $table->text('title');
            $table->string('file_path')->nullable();
            $table->text('description')->nullable();
            $table->text('button')->nullable();
            $table->text('right_label')->nullable();
            $table->text('left_label')->nullable();
            $table->text('center_label')->nullable();
            $table->text('shape')->nullable();
            $table->unsignedInteger('min')->nullable();
            $table->unsignedInteger('max')->nullable();
            $table->unsignedInteger('range')->nullable();
            $table->boolean('required')->default(0);
            $table->boolean('randomize')->default(0);
            $table->boolean('vertical')->default(0);
            $table->boolean('multiple')->default(0);
            $table->boolean('no_label')->default(0);
            $table->boolean('double_size')->default(0);
            $table->boolean('decimal')->default(0);
            $table->boolean('zero_based')->default(0);
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
        Schema::dropIfExists('questions');
    }
}
