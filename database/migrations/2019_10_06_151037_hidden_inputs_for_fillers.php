<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HiddenInputsForFillers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fillers', function (Blueprint $table) {
            $table->text('hiddens')->nullable()->after('finished_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fillers', function (Blueprint $table) {
            $table->dropColumn('hiddens');
        });
    }
}
