<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRegistrationOpenToConfigTable extends Migration
{
    public function up()
    {
        Schema::table('config', function (Blueprint $table) {
            $table->tinyInteger('registration_open')->default(1)->after('number');
        });
    }

    public function down()
    {
        Schema::table('config', function (Blueprint $table) {
            $table->dropColumn('registration_open');
        });
    }
}
