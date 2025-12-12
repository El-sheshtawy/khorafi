<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSliderVideoToConfigTable extends Migration
{
    public function up()
    {
        Schema::table('config', function (Blueprint $table) {
            $table->string('slider_video')->nullable();
        });
    }

    public function down()
    {
        Schema::table('config', function (Blueprint $table) {
            $table->dropColumn('slider_video');
        });
    }
}
