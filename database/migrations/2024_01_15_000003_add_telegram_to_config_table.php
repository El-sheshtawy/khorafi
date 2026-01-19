<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTelegramToConfigTable extends Migration
{
    public function up()
    {
        Schema::table('config', function (Blueprint $table) {
            $table->string('telegram')->nullable();
        });
    }

    public function down()
    {
        Schema::table('config', function (Blueprint $table) {
            $table->dropColumn('telegram');
        });
    }
}
