<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionPointRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_point_rules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('question_id');
            $table->string('type');
            $table->string('value');
            $table->string('action');
            $table->string('target');
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
        Schema::dropIfExists('question_point_rules');
    }
}
